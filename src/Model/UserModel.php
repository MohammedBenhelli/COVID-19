<?php

namespace Model;

use Core\ORM;
use Core\Request;
use PDO;

class UserModel
{
    private \PDO $connect;
    private $query;
    private $request;
    private string $email;
    private string $password;
    private $ORM;

    public function __construct()
    {
        $this->ORM = new ORM();
        $this->request = new Request();
        $this->request->secure();
        $this->connect = new PDO('mysql:host=localhost:3308;dbname=mvcpiephp', "root", "");
        $this->query = "INSERT INTO users(id, email, password) VALUES (NULL, ?, ?)";
        $this->email = $_POST["email"];
        $this->password = $_POST["password"];
    }

    public function create():string
    {
//        $register = $this->connect->prepare($this->query);
//        $register->execute([$this->email, $this->password]);
//        $getId = $this->connect->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
//        $getId->execute([$this->email]);
//        return $getId->fetchAll()[0][0];
        return $this->ORM->create("users", ["email" => $this->email, "password" => $this->password]);
    }

    public function read($id):array
    {
        $read = $this->connect->prepare("SELECT * FROM users WHERE id=?");
        $read->execute([$id]);
        return $read->fetchAll(PDO::FETCH_CLASS);
    }

    public function update($id):bool
    {
        $this->request->secure();
        $update = $this->connect->prepare("UPDATE users SET email=?, password=? WHERE id=?");
        return $update->execute([$_POST["email"], $_POST["password"], $id]);
    }

    public function delete($id):bool
    {
        $delete = $this->connect->prepare("DELETE FROM users WHERE id=?");
        return $delete->execute([$id]);
    }

    public function read_all():array
    {
        $readAll = $this->connect->prepare("SELECT * FROM users");
        $readAll->execute();
        return $readAll->fetchAll();
    }

    public function run()
    {
        echo __CLASS__ . " [ OK ]" . PHP_EOL ;
    }
}