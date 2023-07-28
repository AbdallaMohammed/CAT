<?php

namespace CatPHP\Database\Managers;

use CatPHP\Database\Grammars\MySQLGrammar;
use CatPHP\Database\Contracts\DatabaseManager;

class MySQLManager implements DatabaseManager
{
    private $instance = null;

    public function connect($host, $username, $password, $dbname): \PDO
    {
        if (! $this->instance) {
            $this->instance = new \PDO(
                "mysql:host=$host;dbname=$dbname",
                $username,
                $password
            );
        }

        return $this->instance;
    }

    public function query($statement, $values = [])
    {
        $stmt = $this->instance->preperate($statement);

        for ($i = 1; $i <= count($values); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function select($columns = '*', $filters = null)
    {
        $query = MySQLGrammar::buildSelectQuery($columns, $filters);

        $stmt = $this->instance->prepare($query);

        if ($filters) {
            foreach ($filters as $key => $filter) {
                $stmt->bindValue($key + 1, end($filter));
            }
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $query = MySQLGrammar::buildDeleteQuery();

        $stmt = $this->instance->prepare($query);

        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }

    public function update($id, $attributes)
    {
        $query = MySQLGrammar::buildUpdateQuery(array_keys($attributes));

        $stmt = $this->instance->prepare($query);

        for ($i = 1; $i <= count($values = array_values($attributes)); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
            if ($i == count($values)) {
                $stmt->bindValue($i + 1, $id);
            }
        }

        return $stmt->execute();
    }

    public function create($data)
    {
        $query = MySQLGrammar::buildInsertQuery(array_keys($data));

        $stmt = $this->instance->prepare($query);

        for ($i = 1; $i <= count($values = array_values($data)); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }

        return $stmt->execute();
    }
}
