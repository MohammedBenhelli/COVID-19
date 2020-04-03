<?php


namespace Controller;

use Core;
use Model\TestModel;

class TestController extends Core\Controller
{
    public function templateAction()
    {
        $this->render("testTemplate", ["string" => "ceci est une string", "array" => ["patrice", "pat", "patoche"]], true);
    }
}