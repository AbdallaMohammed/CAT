<?php

namespace CatPHP\Http;

use CatPHP\Http\Traits\HasURL;
use Symfony\Component\HttpFoundation\Request as BaseRequest;

class Request extends BaseRequest
{
    /**
     * Parse the requested path.
     *
     * @return string
     */
    public function path(): string
    {
        $path = $this->server('REQUEST_URI', '/');

        return str_contains($path, '?') ? explode('?', $path)[0] : $path;
    }

    /**
     * Retrieve an input item from the request.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function all($key = null, $default = null)
    {
        return data_get(
            $_POST + $_GET,
            $key,
            $default
        );
    }

    /**
     * Retrieve a query string item from the request.
     *
     * @param  string|null  $key
     * @param  string|array|null  $default
     * @return string|array|null
     */
    public function query($key = null, $default = null)
    {
        return data_get($_GET, $key, $default);
    }

    /**
     * Retrieve a post item from the request.
     *
     * @param  string|null  $key
     * @param  string|array|null  $default
     * @return string|array|null
     */
    public function input($key = null, $default = null)
    {
        return data_get($_POST, $key, $default);
    }

   /**
     * Determine if the request is missing a given input item key.
     *
     * @param  string|array  $key
     * @return bool
     */
    public function missing($key)
    {
        return ! $this->has($key);
    }

    /**
     * Determine if the request contains a given input item key.
     *
     * @param  string|array  $key
     * @return bool
     */
    public function exists($key)
    {
        return $this->has($key);
    }

    /**
     * Determine if the request contains a given input item key.
     *
     * @param  string|array  $key
     * @return bool
     */
    public function has($key)
    {
        $input = $this->all();

        return array_key_exists($key, $input);
    }

    /**
     * Retrieve a server variable from the request.
     *
     * @param  string|null  $key
     * @param  string|array|null  $default
     * @return string|array|null
     */
    public function server($key = null, $default = null)
    {
        return $_SERVER[strtoupper($key)] ?? $default;
    }

    /**
     * Get the request method.
     *
     * @return string
     */
    public function method()
    {
        return $this->server('REQUEST_METHOD') ?? 'GET';
    }
}