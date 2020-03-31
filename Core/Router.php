<?php


namespace Core;

class Router
{
    private static array $routes;

    public static function connect(string $url, array $route): bool
    {
        self::$routes[$url] = $route;
//        print_r(self::$routes);
        return true;
    }

    public static function get(string $url): array
    {
        if(isset(self::$routes[$url])) return self::$routes[$url];
        else return ["null"];
//        return ["controller" => explode("/", $url)[2], "action" => explode("/", $url)[3]];
    }
}