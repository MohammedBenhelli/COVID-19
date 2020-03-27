<?php
define("BASE_URI", str_replace(substr('\ ', 0, 1), "/", substr(__DIR__, strlen($_SERVER ['DOCUMENT_ROOT']))));
require_once('Core/autoload.php');
$app = new Core\Core();
$app->run();

//echo "<br>";
//print_r(\Core\Router::get(substr($_SERVER["REDIRECT_URL"], 11)));
$router = \Core\Router::get(substr($_SERVER["REDIRECT_URL"], 11));
$classname = substr("Controller\ ", 0, 11) . ucfirst($router["controller"]) . "Controller";
$action = $router["action"] . "Action";
$controller = new $classname;
$controller->$action();
//$url = explode("/", $_SERVER["REQUEST_URI"]);
//if (isset($url[2])) $className = substr("Controller\ ", 0, 11) . ucfirst($url[2]) . "Controller";
//if (isset($url[3])) $method = $url[3]."Action";
//if (class_exists($className, false)){
//    $controller = new $className;
//    if (method_exists($controller, $method)) $controller->$method();
//    else $controller->indexAction();
//}
//else {
//    $controller = new Controller\AppController();
//    $controller->indexAction();
//}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>
<pre>
    <?php
    var_dump($_POST);
    var_dump($_GET);
    var_dump($_SERVER);
    ?>
</pre>
</body>
</html>