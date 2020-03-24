<?php


namespace Core;

class Router
{
    private static array $routes;

    public static function connect(string $url, array $route):bool {
        self::$routes[$url] = $route;
        return true;
    }

    public static function get($url):array {
        return ["controller" => explode("/", $url)[2], "action" => explode("/", $url)[3]];
    }
}