<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

trait CarTrait
{

    /**
     * Obtener los productos que estan en el carrito de compras
     * @param string $session_key
     * @return array
     */
    public function getProductsOnShoppingCart($session_key = null) : array
    {
        $data = array();
        try {
            if (isset($session_key)) {
                if (Cache::has($session_key)) {
                    $data = Cache::get($session_key);
                    $data = json_decode($data, true);
                }
            } else {
                if (Session::has('user_shopping_cart')) {
                    $key = Session::get('user_shopping_cart');
                    if (Cache::has($key)) {
                        $data = Cache::get($key);
                        $data = json_decode($data, true);
                    }
                }
            }
        } catch (\Throwable $th) {
            $data = array();
        }

        return $data;
    }
}
