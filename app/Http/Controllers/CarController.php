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
            Cache::put(Session::get('user_shopping_cart'), json_encode($value), now()->addMinutes(600));
        } else {
            $key = Auth::guest() ? 'guest' . time() : auth()->user()->id;
            Session::put('user_shopping_cart', $key);
            Cache::add($key, json_encode([$request->sku => $request->amount]), now()->addMinutes(600));
            $product_amount = $request->amount;
        }

        $this->updateKeyFromCacheAndSession();

        return back()
            ->withStatus(__('El producto "' . $request->name . '" ha sido agregado al carrito de compras satisfactoriamente.'))
            ->with('product_amount', $product_amount);
    }

    /**
     * Borra productos del carro de compras
     * @param \Illuminate\Http\Request $request
     */
    public function removeFromShoppingCart(Request $request)
    {
        $request->validate([
            'sku' => ['required', 'string'],
        ]);

        $this->updateKeyFromCacheAndSession();

        $value = $this->getProductsOnShoppingCart();

        if (count($value) > 0) {
            if (!isset($value[$request->sku])) {
                return back()
                    ->withStatus(__('El producto seleccionado no se encuentra en el carro de compras.'))
                    ->with('product_amount', array_sum($value));
            }

            unset($value[$request->sku]);
            $product_amount = array_sum($value);
            Cache::put(Session::get('user_shopping_cart'), json_encode($value), now()->addMinutes(600));
        } else {
            return back()->withStatus(__('El carro de compras esta vac??o.'))->with('product_amount', 0);
        }

        return back()
            ->withStatus(__('El producto "' . $request->name . '" ha sido eliminado del carrito de compras satisfactoriamente.'))
            ->with('product_amount', $product_amount);
    }

    /**
     * Actualizar la cantidad de un articulo del carro de compras
     * @param \Illuminate\Http\Request $request
     */
    public function updateShoppingCartQuantity(Request $request)
    {
        $request->validate([
            'sku' => ['required', 'string'],
            'session_key' => ['required', 'string'],
            'amount' => ['required', 'integer', 'min:1'],
        ]);

        $this->updateKeyFromCacheAndSession();

        if (auth()->check()) {
            $request->merge([
                'session_key' => auth()->user()->id
            ]);

            $value = $this->getProductsOnShoppingCart($request->session_key);
        } else {
            $value = $this->getProductsOnShoppingCart($request->session_key);
        }

        $subtotal = 0;
        $discount = 0;
        $total = 0;
        $product_amount = 0;

        if (count($value) > 0) {
            if (!isset($value[$request->sku])) {
                return back()
                    ->withStatus(__('El producto seleccionado no se encuentra en el carro de compras.'))
                    ->with('product_amount', array_sum($value));
            }

            $value[$request->sku] = $request->amount;

            foreach ($value as $sku => $quantity_product) {
                $product = Product::where('sku', $sku)->get()[0];
                $subtotal += $quantity_product * $product->price;
                $discount += ($quantity_product * $product->price) * ($product->discount / 100);
                $total += ($quantity_product * $product->price) - (($quantity_product * $product->price) * ($product->discount / 100));
            }

            $product_amount = array_sum($value);

            if (isset($request->session_key)) {
                Cache::put($request->session_key, json_encode($value), now()->addMinutes(600));
            } else {
                Cache::put(Session::get('user_shopping_cart'), json_encode($value), now()->addMinutes(600));
            }
        } else {
            return response()->json(array(
                'message' => __('El carro de compras esta vac??o.'),
                'product_amount' => 0,
                'subtotal' => 0,
                'discount' => 0,
                'total' => 0
            ), 200);
        }

        return response()->json(array(
            'message' => __('El producto ha sido actualizado en el carrito de compras satisfactoriamente.'),
            'product_amount' => $product_amount,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total
        ), 200);
    }

    /**
     * Limpiar el carro de compras
     */
    public function cleanShoppingCart()
    {
        Cache::flush();
        Session::flush();

        return back()
            ->withStatus(__('El carrito de compras ha sido vaciado satisfactoriamente.'));
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->updateKeyFromCacheAndSession();
        $value = $this->getProductsOnShoppingCart();
        $subtotal = 0;
        $discount = 0;
        $total = 0;

        if (count($value) > 0) {
            $product_amount = array_sum($value);
            $message = __('A continuaci??n encontraras toda la informaci??n de los productos seleccionados, para realizar la compra solo continua con tu compra y procede al pago.');
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
            $message = __('El carro de compras esta vac??o.');
            $product_amount = 0;
            $products = array();
        }

        return view('car.car', compact('message', 'product_amount', 'products', 'subtotal', 'discount', 'total'));
    }

    /**
     * Actualizar la llave de la session y la cache
     */
    private function updateKeyFromCacheAndSession()
    {
        if (auth()->check() && Session::has('user_shopping_cart')) {
            $key = Session::get('user_shopping_cart');
            $value = Cache::get($key);
            $value = json_decode($value, true);
            Session::remove('user_shopping_cart');
            Cache::forget($key);

            Session::put('user_shopping_cart', auth()->user()->id);
            Cache::add(auth()->user()->id, json_encode($value), now()->addMinutes(600));
        }
    }
}
