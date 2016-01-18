<?php

//require_once __DIR__ . '/../classes/db.php';

class News
    extends AbstractModel
{
    public $id;
    public $title;
    public $text;

    protected static $name = 'News';
}
