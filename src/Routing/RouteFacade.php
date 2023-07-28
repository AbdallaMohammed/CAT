<?php

namespace CatPHP\Routing;

use LordDashMe\StaticClassInterface\Facade;

class RouteFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getStaticClassAccessor()
    {
        return '\CatPHP\Routing\Router';
    }
}