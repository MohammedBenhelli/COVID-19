<?php

namespace Core ;

class Core
{
    public function run()
    {
        include $_SERVER['DOCUMENT_ROOT']."/MVC_PiePHP/src/routes.php";
    }
}
