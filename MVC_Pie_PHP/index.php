<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/MVC_PiePHP/webroot/css/tailwind.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <script src="/MVC_PiePHP/webroot/js/jquery.min.js"></script>
    <title>Index</title>
</head>
<body>
<?php
session_start();
define("BASE_URI", str_replace(substr('\ ', 0, 1), "/", substr(__DIR__, strlen($_SERVER ['DOCUMENT_ROOT']))));
require_once('Core/autoload.php');
$app = new Core\Core();
$app->run();

\Core\Router::init();

//$router = \Core\Router::get(substr($_SERVER["REDIRECT_URL"], 11));
//if ($router !== ["null"]) {
//    $classname = substr("Controller\ ", 0, 11) . ucfirst($router["controller"]) . "Controller";
//    $action = $router["action"] . "Action";
//    $controller = new $classname;
//    $controller->$action();
//} else {
//    $url = explode("/", $_SERVER["REQUEST_URI"]);
//    if (isset($url[2])) $className = substr("Controller\ ", 0, 11) . ucfirst($url[2]) . "Controller";
//    if (isset($url[3])) $method = $url[3] . "Action";
//    if (class_exists($className, false)) {
//        $controller = new $className;
//        if (method_exists($controller, $method)) $controller->$method();
//        else $controller->indexAction();
//    } else {
//        $controller = new Controller\AppController();
//        $controller->indexAction();
//    }
//}
?>
<pre>
    <?php
    var_dump($_POST);
    var_dump($_GET);
    var_dump($_SESSION);
    var_dump($_SERVER);
    ?>
</pre>
</body>
</html>