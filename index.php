<?php

$controller = $_GET['c'] ?? 'Auth';
$method = $_GET['m'] ?? 'loginForm';

$protectedControllers = ['Category', 'Recap','TaskList'];

if(in_array($controller, $protectedControllers) && !isset($_SESSION['user_id'])) {
    require_once "middleware/AuthMiddleware.php";
    requireAuth();
}

require_once "controller/Controller.php";
require_once "controller/" . $controller . "Controller.php";

$c = new $controller;
$c->$method();