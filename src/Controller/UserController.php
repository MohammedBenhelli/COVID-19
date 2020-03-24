<?php

namespace Controller;

class UserController
{
    public function run(){
        echo __CLASS__ . " [ OK ]" . PHP_EOL ;
    }

    public function addAction(){
        echo "ouai";
    }

    public function indexAction(){
        echo "<h2 style='color: #9b0400'>404</h2>";
    }
}