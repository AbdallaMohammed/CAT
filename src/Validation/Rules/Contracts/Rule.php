<?php

namespace CatPHP\Validation\Rules\Contracts;

interface Rule
{
    public function apply($field, $value, $data);

    public function message();
}