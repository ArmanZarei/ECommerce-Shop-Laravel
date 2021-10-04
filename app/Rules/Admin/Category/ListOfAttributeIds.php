<?php

namespace App\Rules\Admin\Category;

use App\Models\Attribute;
use Illuminate\Contracts\Validation\Rule;

class ListOfAttributeIds implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Attribute::whereIn('id', $value)->count() == sizeof($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Attribute IDs';
    }
}
