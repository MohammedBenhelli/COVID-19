<?php

namespace Model;

use PDO;

class UserModel
{
    private $connect;
    private $query;
    private string $email;
    private string $password;

    public function __construct(string $mail, string $password)
    {
        $this->connect = new PDO('mysql:host=localhost:3308;dbname=mvcpiephp', "root", "");
        $this->query = "INSERT INTO users(id, email, password) VALUES (NULL, ?, ?)";
        $this->email = $mail;
        $this->password = $password;
    }

    public function save():bool
    {
        $register = $this->connect->prepare($this->query);
        return $register->execute([$this->email, $this->password]);
    }

    public function run()
    {
        echo __CLASS__ . " [ OK ]" . PHP_EOL ;
    }
}