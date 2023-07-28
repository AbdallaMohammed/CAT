<?php

namespace CatPHP\Http\Traits;

trait HasURL
{
    /**
     * @return string
     */
    protected function getFullURL()
    {
        $path  = $_SERVER['REQUEST_URL'] ?? '';
        $port  = $_SERVER['SERVER_PORT'] ?? '';
        $host  = $_SERVER['SERVER_NAME'] ?? '';
        $https = $_SERVER['HTTPS']       ?? '';

        $scheme = $https === 'on' ? 'https:' : 'http:';

        $port = in_array($port, ['80', '443']) ? '' : ':' .  $port;

        return strtolower($scheme . ($host ? '//' . $host : '')) . $port . $path;
    }
}