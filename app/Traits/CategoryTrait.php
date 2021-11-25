<?php

namespace App\Traits;

use App\Models\Category;

trait CategoryTrait
{

    /**
     * Armar el selector de categorías para la vista de productos
     */
    public static function assembleCategorySelector(): array
    {
        $categories = Category::select('id', 'name')->get();
        $response = array();

        foreach ($categories as $item) {
            $response[$item->id] = $item->name;
        }

        return $response;
    }
}
