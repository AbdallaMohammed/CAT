<?php

namespace CatPHP\Database\Managers;

final class ManagerMapper
{
    private static $drivers = [
        'mysql' => MySQLManager::class,
    ];

    public static function create($driver, $config)
    {
        if (! isset(self::$drivers[$driver])) {
            throw new \InvalidArgumentException("Driver '$driver' not found");
        }

        $driver = new self::$drivers[$driver]();

        $driver->connect(...$config);

        return $driver;
    }
}