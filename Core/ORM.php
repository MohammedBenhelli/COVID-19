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
        $request = "INSERT INTO $table(";
        $requestEnd = " VALUES (";
        $tab = [];
        foreach ($fields as $key => $value){
            $request .= $key.",";
            $requestEnd .= "?,";
            array_push($tab, $value);
        }
        $request = rtrim($request, ",").") ";
        $requestEnd = rtrim($requestEnd, ",").")";
        $create = $this->connect->prepare($request.$requestEnd);
        $create->execute($tab);
        $return = $this->connect->prepare("SELECT LAST_INSERT_ID()");
        $return->execute();
        return $return->fetchAll()[0][0];
    }

    public function read(string $table, string $id):array
    {
        $request = "SELECT * FROM $table WHERE id=?";
        $read = $this->connect->prepare($request);
        if($read->execute([$id])) return $read->fetchAll(PDO::FETCH_CLASS);
        else return ["null"];
    }

    public function update(string $table, string $id, array $fields):bool
    {
        $request = "UPDATE $table SET ";
        $tab = [];
        foreach ($fields as $key => $value){
            $request .= $key."=?,";
            array_push($tab, $value);
        }
        array_push($tab, $id);
        $request = rtrim($request, ",")." WHERE id=?";
        $update = $this->connect->prepare($request);
        return $update->execute($tab);
    }

    public function delete(string $table, string $id):bool
    {
        $request = "DELETE FROM $table WHERE id=?";
        $delete = $this->connect->prepare($request);
        return $delete->execute([$id]);
    }

    public function find(string $table, array $params):array
    {

    }
}