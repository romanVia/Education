<?php

//require __DIR__ . '/model/news.php';
//$items = getAll();
//include __DIR__ . '/view/index.php';

abstract class Shape
{
    function getInfo() {
        echo 'info';
    }

    abstract function set();
}

interface Drawable
{

}

class Unit extends Shape implements Drawable
{
    function set() {
        echo 'set';
    }
}

$test = new Unit();
$test->set();

?>
