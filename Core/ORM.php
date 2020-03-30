<?php


namespace Core;

use PDO;

class ORM
{
    private \PDO $connect;

    public function __construct()
    {
        $this->connect = new PDO('mysql:host=localhost:3308;dbname=mvcpiephp', "root", "");
    }

    public function create(string $table, array $fields):string
    {

    }

    public function read(string $table, string$id):array
    {

    }

    public function update(string $table, string $id, array $fields):bool
    {

    }

    public function delete(string $table, string $id):bool
    {

    }

    public function find(string $table, array $params):array
    {

    }
}