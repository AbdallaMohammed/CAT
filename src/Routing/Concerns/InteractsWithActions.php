<?php

namespace CatPHP\Routing\Concerns;

use CatPHP\Application;

trait InteractsWithActions
{
    /**
     * Determine whether the route's action is a controller.
     *
     * @return bool
     */
    protected function isControllerAction()
    {
        return is_string($this->action);
    }

    /**
     * Parse the controller.
     *
     * @param int|null $index
     * @return array
     */
    protected function parseController($index = null)
    {
        $parts = explode('@', $this->action);

        return !is_null($index) ? $parts[$index] : $parts;
    }

    /**
     * Run the route action and return the response.
     *
     * @param \CatPHP\Application
     * @return mixed
     */
    protected function runController(Application $app)
    {
        $parameters = $this->getActionParameters($app);

        $controller = ltrim($this->parseController(0), '\\');
        $method = $this->parseController(1);

        $controller = $this->invokeController($controller);

        return $controller->{$method}(...array_values($parameters));
    }

    /**
     * Try to invoke a new instance of the given controller name.
     *
     * @param string $controller
     * @return mixed
     */
    protected function invokeController($controller)
    {
        $controller = $this->prependPropperNamespace($controller);

        return new $controller;
    }

    /**
     * Add default namespace.
     *
     * @param string $controller
     * @return string
     */
    private function prependPropperNamespace($controller)
    {
        return $this->namespace.'\\'.$controller;
    }

    /**
     * Get default parameters for the controller.
     *
     * @param \CatPHP\Application
     * @return array
     */
    protected function getActionParameters(Application $app)
    {
        return [
            'request' => $app->getRequest(),
            'response' => $app->getResponse(),
        ];
    }
}