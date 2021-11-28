<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Traits\CarTrait;

class StoreController extends Controller
{
    Use CarTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::getAllProducts();
        $value = $this->getProductsOnShoppingCart();
        $product_amount = array_sum($value);

        return view('dashboard', compact('products', 'product_amount'));
    }

    /**
     * Show the application dashboard.
     * @param App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function indexByCategory(Category $category)
    {
        $products = Product::getAllProducts($category->id);
        $value = $this->getProductsOnShoppingCart();
        $product_amount = array_sum($value);

        return view('bycategory', compact('products', 'product_amount'));
    }
}
