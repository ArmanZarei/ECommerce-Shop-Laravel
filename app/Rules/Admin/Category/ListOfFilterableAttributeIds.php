<?php

namespace App\Rules\Admin\Category;

use Illuminate\Contracts\Validation\Rule;

class ListOfFilterableAttributeIds implements Rule
{
    private $attributes;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $v)
            if (!in_array($v, $this->attributes))
                return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Filterable Attributes should be from attributes that you have chosen';
    }
}
