<?php


namespace Core;

class Controller
{
    private static string $_render;

    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = $_SERVER["DOCUMENT_ROOT"] . "/MVC_PiePHP/src/View/" . $view . ".php";

         if (file_exists($f)) {
            ob_start();
            include $_SERVER["DOCUMENT_ROOT"] . "/MVC_PiePHP/src/View/" . $view . ".php";
            $view = ob_get_clean();
            ob_start();
            include $_SERVER["DOCUMENT_ROOT"] . "/MVC_PiePHP/src/View/index.php";
            self::$_render = ob_get_clean();
            echo self::$_render;
        }
    }
}