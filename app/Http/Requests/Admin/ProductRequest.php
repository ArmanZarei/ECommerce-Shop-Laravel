<?php

namespace App\Http\Requests\Admin;

use App\Rules\Admin\Product\AttributeIdsExist;
use App\Rules\Admin\Product\TagIdsExist;
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

    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
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
            'brand_id' => 'nullable|exists:brands,id',
            'tag_ids' => ['nullable', 'array', new TagIdsExist],
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'attributes.*' => 'required',
            'product_variations' => 'required|array',
            'product_variations.*' => 'required',
            'product_variations.*.value' => 'required',
            'product_variations.*.price' => 'required',
            'product_variations.*.quantity' => 'required|integer',
            'main_image' => 'required|image',
            'images' => 'required|array',
            'images.*' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'attributes.*.required' => 'The attribute value is required.',
            'product_variations.*.value.required' =>  'The attribute value if required',
            'product_variations.*.price.required' =>  'The attribute price if required',
            'product_variations.*.quantity.required' =>  'The attribute quantity if required',
            'product_variations.*.quantity.integer' =>  'The attribute quantity must be an integer',
        ];
    }
}
