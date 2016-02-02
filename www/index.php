<?php
error_reporting(E_ALL);
require_once __DIR__ . '/autoload.php';

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'news';
$act = isset($_GET['act']) ? $_GET['act'] : 'all';

$controllerClassName = $ctrl . 'Controller';
//require_once __DIR__ . '/controllers/' . $controllerClassName . '.php';
$controller = new $controllerClassName;
$method = 'action' . $act;
?><pre><?php $controller->$method(); ?></pre><?php

//include __DIR__ . '/views/index.php';
