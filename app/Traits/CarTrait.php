<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

trait CarTrait
{

    /**
     * Obtener los productos que estan en el carrito de compras
     * @return array
     */
    public function getProductsOnShoppingCart() : array
    {
        $data = array();
        try {
            if (Session::has('user_shopping_cart')) {
                $key = Session::get('user_shopping_cart');
                if (Cache::has($key)) {
                    $data = Cache::get($key);
                    $data = json_decode($data, true);
                }
            }
        } catch (\Throwable $th) {
            $data = array();
        }

        return $data;
    }
}
