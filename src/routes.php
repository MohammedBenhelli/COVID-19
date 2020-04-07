<?php

Core\Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Core\Router::connect('/register', ['controller' => 'user', 'action' => 'add']);
Core\Router::connect('/cinema/register', ['controller' => 'user', 'action' => 'add']);
Core\Router::connect('/cinema/login', ['controller' => 'user', 'action' => 'login']);
Core\Router::connect('/registerRequest', ['controller' => 'user', 'action' => 'register']);
Core\Router::connect('/loginRequest', ['controller' => 'user', 'action' => 'loginVerif']);
Core\Router::connect('/user/{id}', ['controller' => 'user', 'action' => 'show']);
Core\Router::connect('/testTemplate', ['controller' => 'test', 'action' => 'template']);
Core\Router::connect('/cinema/filmSearch', ['controller' => 'film', 'action' => 'show']);
Core\Router::connect('/cinema/home', ['controller' => 'user', 'action' => 'home']);
Core\Router::connect('/cinema/delete', ['controller' => 'user', 'action' => 'delete']);
Core\Router::connect('/cinema/modify', ['controller' => 'user', 'action' => 'modify']);
Core\Router::connect('/cinema/modifyRequest', ['controller' => 'user', 'action' => 'modifyRequest']);
