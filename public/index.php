<?php

require __DIR__.'\..\vendor\autoload.php';

/**
 * Роуты
 *
 */
$router = new Core\Router();

/* Добавляем маршруты */
$router->add('/', ['controller' => 'TaskController', 'action' => 'index']);

$router->add('/create',     ['controller' => 'TaskController', 'action' => 'create']);
$router->add('/task/store', ['controller' => 'TaskController', 'action' => 'store']);
$router->add('/login', 	    ['controller' => 'AuthController', 'action' => 'index']);
$router->add('/logout', 	['controller' => 'AuthController', 'action' => 'logout']);
$router->add('/login/auth', ['controller' => 'AuthController', 'action' => 'login']);
$router->add('/task',	    ['controller' => 'TaskController', 'action' => 'index']);
$router->add('/task/check',	['controller' => 'TaskController', 'action' => 'check']);
$router->add('/task/edit',	['controller' => 'TaskController', 'action' => 'edit']);
$router->add('/task/update',['controller' => 'TaskController', 'action' => 'update']);
$router->add('/dayside',	['controller' => 'TaskController', 'action' => 'index']);

$router->processing($_SERVER['REQUEST_URI']);