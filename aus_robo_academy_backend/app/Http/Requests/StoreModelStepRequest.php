<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModelStepRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
            $this->has('obj') ? 'mtl' : '' => $this->has('obj') ? 'required|mimes:txt' : '',
            $this->has('mtl') ? 'obj' : '' => $this->has('mtl') ? 'required|mimes:txt' : ''
        ];
    }
}
