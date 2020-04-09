<?php

namespace Controller;

use Core;
use Model\FilmModel;
use Model\HistoryModel;

class HistoryController extends Core\Controller
{
    public function showAction()
    {
        $list = [];
        $film = new FilmModel();
        $model = new HistoryModel();
        $history = $model->getHistory();
        foreach ($history as $value){
            $tmp = $film->getFilmId($value->id_film);
            $tmp["historyId"] = $value->id;
            array_push($list, $tmp);
        }
        $this->render("header");
        $this->render("historyResult", ["films" => $list], true);

    }

    public function addHistoryAction(string $id)
    {
        $model = new HistoryModel();
        $model->getORM()->create("history", ["id_film" => $id, "id_membre" => $_SESSION["id"]]);
        $this->showAction();
    }

    public function removeHistoryAction(string $id)
    {
        $model = new HistoryModel();
        $model->getORM()->delete("history", $id);
        $this->showAction();
    }
}