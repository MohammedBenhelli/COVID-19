<?php


namespace Controller;

use Core;
use Model\TestModel;

class TestController extends Core\Controller
{
    public function templateAction()
    {
        $this->render("testTemplate", ["record" => ["oui"], "test" => ["patrice", "pat", "patoche"]], true);
    }
}