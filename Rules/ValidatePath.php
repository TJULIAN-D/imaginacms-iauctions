<?php

namespace Modules\Iauctions\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidatePath implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute - Example: Attribute name:
     * @param  mixed  $value - Example Path. 
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        return app($value);  

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Path not found';
    }
}