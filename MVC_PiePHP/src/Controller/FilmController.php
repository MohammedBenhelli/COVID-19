<?php


namespace Controller;

use Core;
use Model\FilmModel;


class FilmController extends Core\Controller
{
    public function showAction()
    {
        $model = new FilmModel($_POST);
        $this->render("header");
        $this->render("filmResult", ["films" => $model->getFilm()], true);
    }
}