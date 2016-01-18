<?php

require_once __DIR__ . '/../classes/db.php';

class News
{
    public $id;
    public $title;
    public $text;

    public static function getAll()
    {
        $db = new DB;
        return $db->execute('SELECT * FROM news', 'News');
    }
}