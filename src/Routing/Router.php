<?php

namespace CatPHP\Routing;

use CatPHP\Application;
use CatPHP\Http\Request;
use CatPHP\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Router
{
    /**
     * An array of the routes keyed by method.
     *
     * @var array
     */
    protected $routes = [];

    /**
     * All of the verbs supported by the router.
     *
     * @var array
     */
    public static $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    /**
     * Register a new GET route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|callable|null  $action
     * @return \CatPHP\Routing\Route
     */
    public function get($uri, $action = null)
    {
        return $this->addRoute(['GET', 'HEAD'], $uri, $action);
    }

    /**
     * Register a new POST route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|callable|null  $action
     * @return \CatPHP\Routing\Route
     */
    public function post($uri, $action = null)
    {
        return $this->addRoute('POST', $uri, $action);
    }

    /**
     * Register a new PUT route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|callable|null  $action
     * @return \CatPHP\Routing\Route
     */
    public function put($uri, $action = null)
    {
        return $this->addRoute('PUT', $uri, $action);
    }

    /**
     * Register a new PATCH route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|callable|null  $action
     * @return \CatPHP\Routing\Route
     */
    public function patch($uri, $action = null)
    {
        return $this->addRoute('PATCH', $uri, $action);
    }

    /**
     * Register a new DELETE route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|callable|null  $action
     * @return \CatPHP\Routing\Route
     */
    public function delete($uri, $action = null)
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    /**
     * Register a new OPTIONS route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|callable|null  $action
     * @return \CatPHP\Routing\Route
     */
    public function options($uri, $action = null)
    {
        return $this->addRoute('OPTIONS', $uri, $action);
    }

    /**
     * Add a route to the underlying route collection.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  \Closure|array|string|callable|null  $action
     * @return \CatPHP\Routing\Route
     */
    protected function addRoute($methods, $uri, $action)
    {
        $route = new Route($uri, $methods, $action);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * Find the route matching a given request.
     *
     * @param  \CatPHP\Application  $app
     * @return \CatPHP\Routing\Route
     */
    public function run(Application $app)
    {
        $currentRoute = null;

        array_map(function ($route) use ($app, &$currentRoute) {
            if ($route->matches($app->getRequest()) && !$currentRoute)
                $currentRoute = $route;
        }, $this->routes);

        $response = $currentRoute?->run($app);

        return $this->prepareResponse($app->getRequest(), $response);
    }

    /**
     * Create a response instance from the given value.
     *
     * @param  \Cat\Http\Request  $request
     * @param  mixed  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function prepareResponse(Request $request, mixed $response)
    {
        if (! $response instanceof SymfonyResponse) {
            $response = new Response($response, 200, ['Content-Type' => 'text/html']);
        }

        $response->prepare($request);

        return $response->send();
    }
}