<?php

$controller = $_GET['c'];
$method = $_GET['m'];

require_once "controller/Controller.php";
require_once "controller/" . $controller . "Controller.php";

$c = new $controller;
$c->$method();