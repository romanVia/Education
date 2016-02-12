<?php

//var_dump($_SERVER['REQUEST_URI']); die;

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/autoload.php';

//$dbh = DB::getInstance()->getObjects('SELECT * FROM news');
//var_dump($dbh);
//exit();

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['act']) ? $_GET['act'] : 'All';

$controllerClassName = $ctrl . 'Controller';
$controller = new $controllerClassName;
$method = 'action' . $act;
?><pre><?php $controller->$method(); ?></pre><?php
