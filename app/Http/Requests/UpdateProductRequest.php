<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => ['required', 'string', 'max:50', Rule::unique((new Product())->getTable())->ignore($this->product->id)],
            'name' => ['required', 'string', 'max:200', Rule::unique((new Product())->getTable())->ignore($this->product->id)],
            'brand' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric'],
            'amount' => ['nullable', 'integer'],
            'discount' => ['nullable', 'integer'],
            'reference' => ['nullable', 'string', 'max:200'],
            'image' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
            'categories' => ['required', 'array']
        ];
    }
}
