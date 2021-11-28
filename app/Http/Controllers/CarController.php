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
