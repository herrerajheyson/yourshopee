<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Traits\UtilTrait;

class ProductController extends Controller
{
    use UtilTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::assembleCategorySelector();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->categories()->sync($request->categories);

        if (isset($request->image)) {
            $image_name = $this->modeImageToPath($request->image);
            $product->image = $image_name;
            $product->save();
        }

        return back()
            ->withStatus(__('El producto "' . $product->name . '" ha sido creado correctamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::assembleCategorySelector();
        return view('products.update', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->fill($request->all())->save();
        $product->categories()->sync($request->categories);
        $this->resetAutoIncrementTable('category_product');

        if (isset($request->image)) {
            $image_name = $this->modeImageToPath($request->image);
            $product->image = $image_name;
            $product->save();

            return back()
                ->withStatus(__('El producto "' . $product->name . '" ha sido actualizado correctamente.'))
                ->with('image', $image_name);
        }

        return back()->withStatus(__('El producto "' . $product->name . '" ha sido actualizado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $message = 'El producto "' .  $product->name . '" ha sido eliminado correctamente.';
        $product->delete();

        return back()->withStatus(__($message));
    }

    /**
     * Mover la imagen referenciada por parametro al
     * repositorio publico
     * @param string
     */
    private function modeImageToPath($image) : string
    {
        $name = time() . '.' . $image->extension();
        $image->move(public_path('argon/img/products'), $name);
        return $name;
    }
}
