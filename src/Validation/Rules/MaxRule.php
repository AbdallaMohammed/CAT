<?php

namespace CatPHP\Validation\Rules;

use CatPHP\Validation\Rules\Contracts\Rule;

class MaxRule implements Rule
{
    private int $max;

    public function __construct($value)
    {
        $this->max = $value;
    }

    public function apply($field, $value, $data)
    {
        return strlen($value) < $this->max;
    }

    public function message()
    {
        return 'The %s field exceeded max chars';
    }
}