<?php

namespace CatPHP\Validation;

use LordDashMe\StaticClassInterface\Facade;

class ValidatorFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getStaticClassAccessor()
    {
        return '\CatPHP\Validation\Validator';
    }
}