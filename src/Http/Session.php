<?php

namespace CatPHP\Http;

use Josantonius\Session\Session as BaseSession;

class Session extends BaseSession
{
    /**
     * Just return an instance of current.
     *
     * @return self
     */
    public function make()
    {
        return $this;
    }
}