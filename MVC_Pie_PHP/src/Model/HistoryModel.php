<?php


namespace Model;

use Core\Entity;
use Core\ORM;
use Core\Request;
use PDO;

class HistoryModel extends Entity
{
    private \PDO $connect;
    private string $query;
    private Request $request;
    protected ORM $ORM;

    public function __construct(array $params = [])
    {
        $this->ORM = new ORM();
        $this->request = new Request();
        $this->request->secure($params);
        parent::__construct($params, $this->ORM);
        $this->connect = new PDO('mysql:host=localhost:3308;dbname=mvcpiephp', "root", "");
    }

    public function getHistory(): array
    {
        return $this->ORM->find("history", ["id_membre" => $_SESSION["id"]], true);
    }

    public function getORM(): ORM
    {
        return $this->ORM;
    }
}
