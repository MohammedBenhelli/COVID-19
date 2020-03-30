<?php

namespace Controller;

use Core;
use Model\UserModel;

class UserController extends Core\Controller
{
    public function run()
    {
        echo __CLASS__ . " [ OK ]" . PHP_EOL;
    }

    public function addAction()
    {
        echo "ouai";
        $this::render("register");
    }

    public function indexAction()
    {
        echo "<h2 style='color: #9b0400'>404</h2>";
    }

    public function registerAction()
    {
        $model = new UserModel();
        if($model->create()) echo "<h3>Account successfully created!</h3>";
    }
}