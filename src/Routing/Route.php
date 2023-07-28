<?php

namespace CatPHP\Routing;

use CatPHP\Application;
use CatPHP\Http\Request;
use CatPHP\Routing\Concerns\InteractsWithActions;

class Route
{
    use InteractsWithActions;

    /**
     * The URI pattern the route responds to.
     *
     * @var string
     */
    public $uri;

    /**
     * The HTTP methods the route responds to.
     *
     * @var array
     */
    public $methods;

    /**
     * The route action array.
     *
     * @var array
     */
    public $action;

    /**
     * The route action namespace.
     *
     * @var array
     */
    public $namespace = '\\App\\Controllers';

    /**
     * Create a new Route instance.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  \Closure|array  $action
     * @return void
     */
    public function __construct($uri, $methods, $action)
    {
        $this->uri = $uri;
        $this->methods = (array) $methods;
        $this->action = $action;
    }

    /**
     * Determine if the route matches given request.
     *
     * @param  \CatPHP\Http\Request  $request
     * @return bool
     */
    public function matches(Request $request)
    {
        return in_array($request->method(), $this->methods) && $request->path() === $this->uri;
    }

    /**
     * Run the route action and return the response.
     *
     * @param \CatPHP\Application $request
     * @return mixed
     */
    public function run(Application $app)
    {
        try {
            if ($this->isControllerAction()) {
                return $this->runController($app);
            }

            return $this->runCallable($app);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}