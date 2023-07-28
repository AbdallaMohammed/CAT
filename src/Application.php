<?php

namespace CatPHP;

use CatPHP\Http\Request;
use CatPHP\Http\Response;
use CatPHP\View\View;

class Application
{
    /**
     * @var \CatPHP\Http\Request
     */
    protected Request $request;

    /**
     * @var \CatPHP\Http\Response
     */
    protected Response $response;

    /**
     * @var \CatPHP\View\View
     */
    protected View $view;

    /**
     * Application Constructor.
     *
     * @param \Cat\Http\Request $request
     * @param \Cat\Http\Response $response
     * @param \Cat\Http\View $view
     */
    public function __construct(Request $request, Response $response, View $view)
    {
        $this->request = $request;
        $this->response = $response;
        $this->view = $view;
    }

    /**
     * @return \Cat\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return \Cat\Http\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}