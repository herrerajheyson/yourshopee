<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class StoreController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::getAllProducts();
        return view('dashboard', compact('products'));
    }

    /**
     * Show the application dashboard.
     * @param App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function indexByCategory(Category $category)
    {
        $products = Product::getAllProducts($category->id);
        return view('bycategory', compact('products'));
    }
}
