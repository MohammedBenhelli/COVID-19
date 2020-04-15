<?php


namespace Model;


use Core\Entity;
use Core\ORM;
use Core\Request;
use PDO;


class FilmModel extends Entity
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
        $this->connect = new PDO('mysql:host=localhost:3308;dbname=cinema', "root", "");
    }

    public function getFilm(): array
    {
        return $this->ORM->find("film", ["titre" => $this->film ."%"]);
    }

    public function getFilmId(string $id_film): array
    {
        return $this->ORM->find("film", ["id_film" => $id_film]);
    }
}