<?php

namespace CatPHP\Database;

use CatPHP\Support\Str;

abstract class Model
{
    protected static $instance;

    public static function all()
    {
        self::$instance = static::class;

        return db()->select();
    }

    public static function create(array $attributes)
    {
        self::$instance = static::class;

        return db()->create($attributes);
    }

    public static function update($id, array $attributes)
    {
        self::$instance = static::class;

        return db()->update($id, $attributes);
    }

    public static function delete($id)
    {
        self::$instance = static::class;

        return db()->delete($id);
    }

    public static function where(...$filter)
    {
        self::$instance = static::class;

        $columns = '*';

        if (is_string(end($filter))) {
            $columns = end($filter);

            unset($filter[count($filter) - 1]);
        }

        return db()->select($columns, $filter);
    }

    public static function getModel()
    {
        return self::$instance;
    }

    public static function getTableName()
    {
        return strtolower(Str::plural(class_basename(self::$instance)));
    }
}