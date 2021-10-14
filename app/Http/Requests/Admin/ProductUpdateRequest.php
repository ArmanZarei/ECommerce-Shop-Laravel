<?php

namespace App\Http\Requests\Admin;

use App\Rules\Admin\Product\TagIdsExist;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        // TODO: Incomplete Validation :/

        $rules = [
            'name'         => 'required|string',
            'brand_id'     => 'nullable|exists:brands,id',
            'tag_ids'      => ['nullable', 'array', new TagIdsExist],
            'is_active'    => 'required|boolean',
            'description'  => 'nullable|string',
            'category_id'  => 'required|exists:categories,id',
            'attributes'   => 'required',
            'attributes.*' => 'required',
            'images.*' => 'image',
        ];

        $allImagesSize = sizeof(array_merge($this->request->get('images') ?? [], $this->request->get('old_image_ids') ?? []));
        if ($allImagesSize == 0)
            $rules['images'] = 'required|array';

        return $rules;
    }

    public function messages()
    {
        return [
            'attributes.*.required' => 'The attribute value is required.',
        ];
    }
}
