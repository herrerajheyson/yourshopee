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
     * Actualizar la cantidad de un articulo del carro de compras
     * @param \Illuminate\Http\Request $request
     */
    public function updateShoppingCartQuantity(Request $request);

