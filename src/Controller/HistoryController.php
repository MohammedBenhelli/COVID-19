<?php

namespace Controller;

use Core;
use Model\FilmModel;
use Model\HistoryModel;

class HistoryController extends Core\Controller
{
    public function showAction(){
        $list = [];
        $film = new FilmModel();
        $model = new HistoryModel();
        $history = $model->getHistory();
        foreach ($history as $value)
            array_push($list, $film->getFilmId($value->id_film));
        $this->render("header");
        $this->render("historyResult", ["films" => $list], true);

    }
}