<?php

spl_autoload_register(function () {
    chdir("Core");
    $dir = glob("*.php");
//    print_r($dir);
    foreach ($dir as $value)
        if (is_file($value))
            include $value;
    chdir("../src/Model");
    $dir = glob("*.php");
//    print_r($dir);
    foreach ($dir as $value)
        if (is_file($value))
            include $value;
    chdir("../Controller");
    $dir = glob("*.php");
//    print_r($dir);
    foreach ($dir as $value)
        if (is_file($value))
            include $value;
});

spl_autoload("");

//spl_autoload_register(function ($class) {
//    echo $class."\n";
//    include $_SERVER["DOCUMENT_ROOT"] . "/MVCPiePHP/" . $class . '.php';
//});

//spl_autoload("Core/Core");
//spl_autoload("Core/Controller");
//spl_autoload("Core/Router");
//spl_autoload("Core/Request");
//spl_autoload("Core/ORM");
//spl_autoload("Core/Entity");
//spl_autoload("src/Model/UserModel");
//spl_autoload("src/Controller/UserController");
//spl_autoload("src/Controller/AppController");