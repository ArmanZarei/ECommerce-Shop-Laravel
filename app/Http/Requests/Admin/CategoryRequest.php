<?php

namespace App\Http\Requests\Admin;

use App\Rules\Admin\Category\ListOfAttributeIds;
use App\Rules\Admin\Category\ListOfFilterableAttributeIds;
use App\Rules\ArraySubArrayOfAnother;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'attributes' => ['sometimes', 'array', new ListOfAttributeIds],
            'filterable_attributes' => ['sometimes', 'array', new ListOfFilterableAttributeIds($this->get('attributes'))],
            'variation_attribute' => 'nullable|in_array:attributes.*',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ];
    }
}
