<?php

require_once __DIR__ . '/../classes/db.php';

function showAll()
{
    $db = new DB('mysql', 'localhost', 'edu', 'root', 'drol21755');
    $arr = $db->query('SELECT * FROM news');
    foreach ($arr as $row) {
        print_r($row);
    }

//    $sql = 'SELECT * FROM news BY date DESC';
}

?>

