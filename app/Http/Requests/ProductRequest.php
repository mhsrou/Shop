<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'desc' => 'required|string',
            'price' => 'Integer',
            'status' => [
                'required',
                Rule::in(['draft', 'available', 'soon', 'running_out']),
            ],
            'image' =>'required|image',
            'category_id.*' => 'exists:categories,id',
        ];
    }
}
