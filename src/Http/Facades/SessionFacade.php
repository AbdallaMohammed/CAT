<?php

namespace CatPHP\Http\Facades;

use LordDashMe\StaticClassInterface\Facade;

class SessionFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getStaticClassAccessor()
    {
        return '\CatPHP\Http\Session';
    }
}