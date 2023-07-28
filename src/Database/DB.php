<?php

namespace CatPHP\Database;

use CatPHP\Database\Contracts\DatabaseManager;

class DB
{
    protected DatabaseManager $dbManager;

    public function __construct(DatabaseManager $dbManager)
    {
        $this->dbManager = $dbManager;
    }

    protected function raw(string $query, $value = [])
    {
        return $this->dbManager->query($query, $value);
    }

    protected function delete($id)
    {
        return $this->dbManager->delete($id);
    }

    protected function update($id, array $attributes)
    {
        return $this->dbManager->update($id, $attributes);
    }

    protected function select($columns = '*', $filter = null)
    {
        return $this->dbManager->select($columns, $filter);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }
    }
}