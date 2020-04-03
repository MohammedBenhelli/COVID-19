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

    public function addAction()
    {
        $this->render("register");
    }

    public function loginAction()
    {
        $this->render("login");
    }

    public function indexAction()
    {
        echo "<h2 style='color: #9b0400'>404</h2>";
    }

    public function loginVerifAction()
    {
        $model = new UserModel(["email" => $_POST["email"], "password" => $_POST["password"]]);
        if ($model->connect()) {
            echo "<h3 class='text-green-400 font-bold'>Successfully connected!</h3>";
            $this->homeAction();
        }
        else {
            echo "<h3 class='text-red-400 font-bold'>Wrong password or mail!</h3>";
            $this->loginAction();
        }
    }

    public function registerAction()
    {
        $model = new UserModel(["email" => $_POST["email"], "password" => $_POST["password"], "passwordVerif" => $_POST["passwordVerif"]]);
//        var_dump($model->email);
        if($model->create()) {
            echo "<h3 class='text-green-400 font-bold'>Account successfully created!</h3>";
            $this->loginAction();
        }
        else {
            echo "<h3 class='text-red-400 font-bold'>Error in your information!</h3>";
            $this->addAction();
        }
    }

    public function homeAction()
    {
        $model = new GenreModel();
        $this->render("header");
        $this->render("home", ["genres" => $model->getGenre(), "distributeurs" => $model->getDistributeur()], true);
    }

    public function showAction(string $id)
    {
        
    }
}