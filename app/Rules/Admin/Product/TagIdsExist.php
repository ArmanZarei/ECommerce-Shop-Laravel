<?php

namespace App\Rules\Admin\Product;

use App\Models\Tag;
use Illuminate\Contracts\Validation\Rule;

class TagIdsExist implements Rule
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
        return Tag::whereIn('id', $value)->count() == sizeof($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Tag Ids';
    }
}
