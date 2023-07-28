<?php

namespace CatPHP\Database\Contracts;

interface DatabaseManager
{
    public function connect($host, $username, $password, $dbname): \PDO;

    public function query(string $query, $values = []);

    public function create($data);

    public function select($columns = '*', $filter = null);

    public function update($id, $data);

    public function delete($id);
}