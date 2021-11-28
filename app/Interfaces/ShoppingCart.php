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
