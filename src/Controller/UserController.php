<?php

namespace Controller;

use Core;

class UserController extends Core\Controller
{
    public function run()
    {
        echo __CLASS__ . " [ OK ]" . PHP_EOL;
    }

    public function addAction()
    {
        echo "ouai";
        $this::render("User/login");
    }

    public function indexAction()
    {
        echo "<h2 style='color: #9b0400'>404</h2>";
    }
}