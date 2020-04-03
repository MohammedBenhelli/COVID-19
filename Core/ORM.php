<?php


namespace Core;

use PDO;

class ORM
{
    private \PDO $connect;
    private \PDO $connectCinema;

    public function __construct()
    {
        $this->connect = new PDO('mysql:host=localhost:3308;dbname=mvcpiephp', "root", "");
        $this->connectCinema = new PDO('mysql:host=localhost:3308;dbname=cinema', "root", "");
    }

    public function create(string $table, array $fields): string
    {
        $request = "INSERT INTO $table(";
        $requestEnd = " VALUES (";
        $tab = [];
        foreach ($fields as $key => $value) {
            $request .= $key . ",";
            $requestEnd .= "?,";
            array_push($tab, $value);
        }
        $request = rtrim($request, ",") . ") ";
        $requestEnd = rtrim($requestEnd, ",") . ")";
        $create = $this->connect->prepare($request . $requestEnd);
        if ($create->execute($tab)) {
            $return = $this->connect->prepare("SELECT LAST_INSERT_ID()");
            $return->execute();
            return $return->fetchAll()[0][0];
        }
        else return "error";
    }

    public function read(string $table, string $id): array
    {
        $request = "SELECT * FROM $table WHERE id=?";
        $read = $this->connect->prepare($request);
        if ($read->execute([$id])) return $read->fetchAll(PDO::FETCH_CLASS);
        else return ["null"];
    }

    public function readMail(string $table, string $mail): array
    {
        $request = "SELECT * FROM $table WHERE email=?";
        $read = $this->connect->prepare($request);
        if ($read->execute([$mail])) return $read->fetchAll(PDO::FETCH_CLASS);
        else return ["null"];
    }

    public function update(string $table, string $id, array $fields): bool
    {
        $request = "UPDATE $table SET ";
        $tab = [];
        foreach ($fields as $key => $value) {
            $request .= $key . "=?,";
            array_push($tab, $value);
        }
        array_push($tab, $id);
        $request = rtrim($request, ",") . " WHERE id=?";
        $update = $this->connect->prepare($request);
        return $update->execute($tab);
    }

    public function delete(string $table, string $id): bool
    {
        $request = "DELETE FROM $table WHERE id=?";
        $delete = $this->connect->prepare($request);
        return $delete->execute([$id]);
    }

    public function readCinema(string $table): array
    {
        $request = "SELECT * FROM $table";
        $read = $this->connectCinema->prepare($request);
        if ($read->execute([])) return $read->fetchAll(PDO::FETCH_CLASS);
        else return ["null"];
    }

    public function find(string $table, array $params): array
    {

    }
}