<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

trait ProductTrait
{

    /**
     * Armar el selector de categorías para la vista de productos
     * @param int $category_id
     */
    public static function getAllProducts(int $category_id = null)
    {
        if (isset($category_id)) {
            $products = Product::with([
                'categories:id,name'
            ])
            ->whereHas('categories', function($category) use ($category_id) {
                $category->where('categories.id', $category_id);
            })
            ->paginate(6);
        } else {
            $products = Product::with([
                'categories:id,name'
            ])->paginate(6);
        }

        return $products;
    }
}
