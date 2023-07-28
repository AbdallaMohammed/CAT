<?php

namespace CatPHP\Validation\Rules;

use CatPHP\Validation\Rules\Contracts\Rule;

class RequiredRule implements Rule
{
    public function apply($field, $value, $data)
    {
        return ! empty($value);
    }

    public function message()
    {
        return 'The %s field is required';
    }
}