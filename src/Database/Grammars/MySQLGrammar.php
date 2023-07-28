<?php

namespace CatPHP\Database\Grammars;

use CatPHP\Database\Model;

class MySQLGrammar
{
    public static function buildSelectQuery($columns = '*', array $filters = [])
    {
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }

        $query = "SELECT {$columns} FROM " . Model::getTableName();

        if ($filters) {
            foreach ($filters as $key => $filter) {
                if ($key === 0) {
                    $query .= " WHERE {$filter[0]} {$filter[1]} ?";
                } else {
                    $query .= " AND {$filter[0]} {$filter[1]} ?";
                }
            }
        }

        return $query;
    }

    public static function buildInsertQuery($keys)
    {
        $values = '';
        for ($i = 0; $i < count($keys); $i++) {
            $values .= '?, ';
        }

        $query = 'INSERT INTO ' . Model::getTableName() . ' (`' . implode('`, `', $keys) . '`) VALUES(' . rtrim($values, ', ') . ')';

        return $query;
    }

    public static function buildUpdateQuery($keys)
    {
        $query = 'UPDATE ' . Model::getTableName() . ' SET ';

        foreach ($keys as $key) {
            $query .= "{$key} = ?, ";
        }

        $query = rtrim($query, ', ') . ' WHERE ID = ?';

        return $query;
    }

    public static function buildDeleteQuery()
    {
        return 'DELETE FROM ' . Model::getTableName() . ' WHERE ID = ?';
    }
}
