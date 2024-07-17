<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'description' => 'required|string',
            'from_age' => 'required|numeric|min:3|max:18',
            'to_age' => 'required|numeric|min:3|max:18',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }
}
