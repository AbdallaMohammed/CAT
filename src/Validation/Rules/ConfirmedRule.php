<?php

namespace CatPHP\Validation\Rules;

class ConfirmedRule
{
    public function apply($field, $value, $data)
    {
        $field = $field.'_confirmation';

        return ! empty($data[$field]) && $data[$field] == $value;
    }

    public function message()
    {
        return 'The %s confirmation is required';
    }
}