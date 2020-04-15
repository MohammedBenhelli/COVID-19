<?php


namespace Controller;

use Core;
use Model\FilmModel;
use Model\GenreModel;
use Model\HistoryModel;

class GenreController extends Core\Controller
{
    public function showAction()
    {
        $model = new GenreModel();
        $this->render("header");
        $this->render("filmResult", ["films" => $model->getFilms()], true);

    }
}