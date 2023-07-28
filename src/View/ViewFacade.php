<?php

namespace CatPHP\View;

use LordDashMe\StaticClassInterface\Facade;

class ViewFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getStaticClassAccessor()
    {
        return '\CatPHP\View\View';
    }
}