<?php

abstract class AbstractModel
{
    protected static $name;

    public static function getAll()
    {
        $db = new DB;
        return $db->execute('SELECT * FROM ' . static::$name, static::$name);
    }

    public static function getOne($id)
    {
        $db = new DB;
        return $db->execute('SELECT * FROM ' . static::$name . ' WHERE id = ?', static::$name, array($id))[0];
    }
}