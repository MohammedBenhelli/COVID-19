<?php

Core\Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Core\Router::connect('/register', ['controller' => 'user', 'action' => 'add']);
Core\Router::connect('/registerRequest', ['controller' => 'user', 'action' => 'register']);