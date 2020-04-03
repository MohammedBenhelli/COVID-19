<?php

namespace Controller;

use Core;
use Model\UserModel;
use Model\GenreModel;

class UserController extends Core\Controller
{
    public function run()
    {
        echo __CLASS__ . " [ OK ]" . PHP_EOL;
    }

    public function addAction(string $message = "", string $error = "")
    {
        $this->render("register", ["message" => $message, "error" => $error], true);
    }

    public function loginAction(string $message = "", string $error = "")
    {
        $this->render("login", ["message" => $message, "error" => $error], true);
    }

    public function indexAction()
    {
        echo "<h2 style='color: #9b0400'>404</h2>";
    }

    public function loginVerifAction()
    {
        $model = new UserModel(["email" => $_POST["email"], "password" => $_POST["password"]]);
        if ($model->connect()) $this->homeAction("Successfully connected!");
        else $this->loginAction("", "Wrong password or mail!");
    }

    public function registerAction()
    {
        $model = new UserModel(["email" => $_POST["email"], "password" => $_POST["password"], "passwordVerif" => $_POST["passwordVerif"]]);
        if($model->create()) $this->loginAction("Account successfully created!");
        else $this->addAction("", "Error in your information!");
    }

    public function homeAction(string $message = "", string $error = "")
    {
        $model = new GenreModel();
        $this->render("header");
        $this->render("home", ["genres" => $model->getGenre(), "distributeurs" => $model->getDistributeur(), "message" => $message, "error" => $error], true);
    }

    public function showAction(string $id)
    {
        
    }
}