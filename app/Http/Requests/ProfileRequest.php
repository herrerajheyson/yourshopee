<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique((new User)->getTable())->ignore(auth()->id())],
            'gender' => ['required', 'string', 'in:F,M,NA'],
            'address' => ['nullable', 'string'],
            'phone' => ['required', 'string', 'max:20'],
        ];
    }
}
