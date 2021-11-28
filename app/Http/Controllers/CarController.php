<?php

namespace App\Http\Controllers;

use App\Interfaces\ShoppingCart;
use App\Models\Product;
use App\Traits\CarTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CarController extends Controller implements ShoppingCart
{
    use CarTrait;

    /**
     * Agrega productos al carro de compras
     * @param \Illuminate\Http\Request $request
     */
    public function addToShoppingCart(Request $request)
    {
        $request->validate([
            'sku' => ['required', 'string'],
            'name' => ['required', 'string', 'max:200'],
            'amount' => ['required', 'integer', 'min:1', 'max:' . (Product::where('sku', $request->sku)->select('amount')->get()[0]->amount)],
        ]);

        $value = $this->getProductsOnShoppingCart();

        if (count($value) > 0) {
            try {
                $value[$request->sku] += $request->amount;
            } catch (\Throwable $th) {
                $value[$request->sku] = $request->amount;
            }

            $product_amount = array_sum($value);
            Cache::put(Session::get('user_shopping_cart'), json_encode($value), now()->addMinutes(30));
        } else {
            $key = Auth::guest() ? 'guest' . time() : auth()->user()->id;
            Session::put('user_shopping_cart', $key);
            Cache::add($key, json_encode([$request->sku => $request->amount]), now()->addMinutes(30));
            $product_amount = $request->amount;
        }

        return back()
            ->withStatus(__('El producto "' . $request->name . '" ha sido agregado al carrito de compras satisfactoriamente.'))
            ->with('product_amount', $product_amount);
    }


    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $value = $this->getProductsOnShoppingCart();
        $subtotal = 0;
        $discount = 0;
        $total = 0;

        if (count($value) > 0) {
            $product_amount = array_sum($value);
            $message = __('A continuación encontraras toda la información de los productos seleccionados, para realizar la compra solo continua con tu compra y procede al pago.');
            $products = array();

            foreach ($value as $sku => $quantity_product) {
                $product = Product::where('sku', $sku)->get()[0];
                $product->requested_amount = $quantity_product;
                $subtotal += $quantity_product * $product->price;
                $discount += ($quantity_product * $product->price) * ($product->discount / 100);
                $total += ($quantity_product * $product->price) - (($quantity_product * $product->price) * ($product->discount / 100));
                $products[] = $product;
            }
        } else {
            $message = __('El carro de compras esta vacío.');
            $product_amount = 0;
            $products = array();
        }

        return view('car.car', compact('message', 'product_amount', 'products', 'subtotal', 'discount', 'total'));
    }
}
