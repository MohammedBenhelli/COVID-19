<?php


namespace Model;

use Core\Entity;
use Core\ORM;
use Core\Request;
use PDO;

class GenreModel extends Entity
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

    public function getGenre(): array
    {
        return $this->ORM->readCinema("genre");
    }

    public function getDistributeur(): array
    {
        return $this->ORM->readCinema("distrib");
    }

    public function getFilms(): array
    {
        return $this->ORM->find("film", ["id_genre" => $_POST["genre"]]);
    }
}