<?php

use CatPHP\View\ViewFacade;
use CatPHP\Database\DB;
use CatPHP\Http\Facades\SessionFacade;
use CatPHP\Database\Managers\ManagerMapper;

if (! function_exists('env')) {
    /**
     * Get an environment variable.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    function env(string $key, $default = null)
    {
        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key];
        }

        return $default;
    }
}

if (! function_exists('base_path')) {
    /**
     * @param string $path
     * @return string
     */
    function base_path($path = '')
    {
        return dirname(__DIR__).'/'.$path;
    }
}

if (! function_exists('url')) {
    /**
     * @param string $path
     * @return string
     */
    function url($path = '')
    {
        return ltrim(env('APP_URL', 'http://localhost'), '/').'/'.$path;
    }
}

if (! function_exists('asset')) {
    /**
     * @param string $path
     * @return string
     */
    function asset($path = '')
    {
        return url($path);
    }
}

if (! function_exists('base_path')) {
    /**
     * @param string $path
     * @return string
     */
    function asset($path = '')
    {
        return dirname(__DIR__) . '/../' . $path;
    }
}

if (! function_exists('view')) {
    /**
     * Render desired view.
     *
     * @param string $view
     * @param mixed $data
     * @return mixed
     */
    function view($view, $data = [])
    {
        return ViewFacade::render($view, $data);
    }
}

if (! function_exists('db')) {
    /**
     * Make a DB connection.
     *
     * @return \CatPHP\Database\DB
     */
    function db()
    {
        return new DB(
            ManagerMapper::create(
                env('DB_DRIVER', 'mysql'),
                [
                    env('DB_HOST', 'localhost'),
                    env('DB_USERNAME', 'root'),
                    env('DB_PASSWORD', 'password'),
                    env('DB_NAME', 'mvc')
                ]
            )
        );
    }
}

if (! function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed  $target
     * @param  string|array|int|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function data_get($target, $key = null, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        foreach ($key as $i => $segment) {
            unset($key[$i]);

            if (is_null($segment)) {
                return $target;
            }

            if ($segment === '*') {
                if (! is_array($target)) {
                    return value($default);
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }

                return in_array('*', $key) ? array_collapse($result) : $result;
            }

            if (array_accessible($target) && array_exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (! function_exists('class_basename')) {
    /**
     * Convert class to just a string.
     *
     * @param string|object $class
     * @return string
     */
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (! function_exists('session')) {
    function session()
    {
        $session = SessionFacade::make();

        if (! $session->isStarted()) {
            $session->start();
        }

        return $session;
    }
}