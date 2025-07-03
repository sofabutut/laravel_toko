<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags.*' => ['required', 'exists:tags,id'],
            'status' => ['required', 'boolean'],
            'weight' => ['required', 'numeric'],
            'description' => ['required', 'max:1000'],
            'details' => ['required', 'max:10000'],
            'images' => ['nullable', 'array'],
            'images.*' => ['mimes:jpg,jpeg,png,gif', 'max:4000']
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] = ['required', 'max:255', 'unique:products,name,' . $this->route('product')->id];
        } else {
            $rules['name'][] = 'unique:products';
        }


        return [
    'name' => ['required', 'max:255', 'unique:products'],
    'price' => ['required', 'numeric'],
    'quantity' => ['required', 'numeric'],
    'category_id' => ['required'],
    'tags.*' => ['required'],
    'status' => ['required'],
    'weight' => ['required', 'numeric'],
    'description' => ['required', 'max:1000'],
    'details' => ['required', 'max:10000'],
    'images' => ['required'],
    'images.*' => ['mimes:jpg,jpeg,png,gif', 'max:4000']
];
    }
}
