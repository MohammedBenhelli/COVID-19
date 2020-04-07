<?php

namespace Model;

use Core\Entity;
use Core\ORM;
use Core\Request;
use PDO;

class UserModel extends Entity
{
    private \PDO $connect;
    private string $query;
    private Request $request;
//    public string $email;
//    public string $password;
//    public string $passwordVerif;
    public ORM $ORM;

    public function __construct(array $params)
    {
        $this->ORM = new ORM();
        $this->request = new Request();
        $this->request->secure($params);
        parent::__construct($params, $this->ORM);
        $this->connect = new PDO('mysql:host=localhost:3308;dbname=mvcpiephp', "root", "");
        $this->query = "INSERT INTO users(id, email, password) VALUES (NULL, ?, ?)";
        if(isset($this->password)) $this->password = hash("SHA512", $this->password);
        if(isset($this->passwordVerif)) $this->passwordVerif = hash("SHA512", $this->passwordVerif);
//        $this->email = $params["email"];
//        $this->password = $params["password"];
    }

    public function create():bool
    {
//        $register = $this->connect->prepare($this->query);
//        $register->execute([$this->email, $this->password]);
//        $getId = $this->connect->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
//        $getId->execute([$this->email]);
//        return $getId->fetchAll()[0][0];
        if($this->password === $this->passwordVerif && $this->ORM->create("users", ["email" => $this->email, "password" => $this->password]) !== "error") return true;
        else return false;
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

    public function connect():bool
    {
        if ($this->ORM->readMail("users", $this->email) !== ["null"] && isset($this->ORM->readMail("users", $this->email)[0]->password))
            if($this->password === $this->ORM->readMail("users", $this->email)[0]->password){
                $_SESSION["id"] = $this->ORM->readMail("users", $this->email)[0]->id;
                return true;
            }
            else return false;
        else return false;
    }

    public function run()
    {
        echo __CLASS__ . " [ OK ]" . PHP_EOL ;
    }
}