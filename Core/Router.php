<?php


namespace Core;

use Controller;

class Router
{
    private static array $routes;

    public static function connect(string $url, array $route): bool
    {
        self::$routes[$url] = $route;
        return true;
    }

    public static function get(string $url): array
    {
        if (isset(self::$routes[$url])) return self::$routes[$url];
        else return ["null"];
    }

    public static function init(): bool
    {
        $router = self::get(substr($_SERVER["REDIRECT_URL"], 11));
        if ($router !== ["null"]) {
            $classname = substr("Controller\ ", 0, 11) . ucfirst($router["controller"]) . "Controller";
            $action = $router["action"] . "Action";
            $controller = new $classname;
            $controller->$action();
            return true;
        } else {
            if (self::arguments()) return true;
            else return self::dynamic();
        }
    }

    public static function dynamic(): bool
    {
        $url = explode("/", $_SERVER["REQUEST_URI"]);
        if (isset($url[2])) $className = substr("Controller\ ", 0, 11) . ucfirst($url[2]) . "Controller";
        if (isset($url[3])) $method = $url[3] . "Action";
        if (isset($className) && class_exists($className, false)) {
            $controller = new $className;
            if (isset($method) && method_exists($controller, $method)) $controller->$method();
            else $controller->indexAction();
            return true;
        } else {
            $controller = new Controller\AppController();
            $controller->indexAction();
            return true;
        }
    }

    public static function arguments(): bool
    {
        $path = "";
        $arguments = [];
        $url = explode("/", substr($_SERVER["REDIRECT_URL"], 11));
        array_shift($url);
        foreach ($url as $key => $value) {
            if (is_numeric($value)) {
                array_push($arguments, $value);
                $path .= "/{id}";
            }
            else $path .= "/$value";
        }
        $router = self::get($path);
        if ($router !== ["null"]) {
            $classname = substr("Controller\ ", 0, 11) . ucfirst($router["controller"]) . "Controller";
            $action = $router["action"] . "Action";
            $controller = new $classname;
            $controller->$action(...$arguments);
            return true;
        }
        else return false;
    }
}