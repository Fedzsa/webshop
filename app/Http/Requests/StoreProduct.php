<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Product::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id'
            ],
            'price' => [
                'required',
                'max:100'
            ],
            'amount' => [
                'required',
                'integer'
            ],
            'description' => [
                'nullable',
                'string',
                'max:10000'
            ]
        ];
    }
}
