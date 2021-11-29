<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'customer_name' => ['required', 'string', 'max:80'],
            'customer_email' => ['required', 'string', 'max:120'],
            'customer_mobile' => ['required', 'string', 'max:40'],
            'status' => ['required', 'string',  'max:20']
        ];
    }
}
