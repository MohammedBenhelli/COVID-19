<?php

spl_autoload_register(function ($class) {
    include $_SERVER["DOCUMENT_ROOT"] . "/MVCPiePHP/" . $class . '.php';
});

spl_autoload("Core/Core");
spl_autoload("Core/Controller");
spl_autoload("Core/Router");
spl_autoload("Core/Request");
spl_autoload("Core/ORM");
spl_autoload("src/Model/UserModel");
spl_autoload("src/Controller/UserController");
spl_autoload("src/Controller/AppController");