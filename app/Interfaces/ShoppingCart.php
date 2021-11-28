<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ShoppingCart
{
    /**
     * Agrega productos al carro de compras
     * @param \Illuminate\Http\Request $request
     */
    public function addToShoppingCart(Request $request);

    /**
     * Borra productos del carro de compras
     * @param \Illuminate\Http\Request $request
     */
    public function removeFromShoppingCart(Request $request);

    /**
     * Actualizar la cantidad de un articulo del carro de compras
     * @param \Illuminate\Http\Request $request
     */
    public function updateShoppingCartQuantity(Request $request);

    /**
     * Limpiar el carro de compras
     * @param \Illuminate\Http\Request $request
     */
    public function cleanShoppingCart();
}
