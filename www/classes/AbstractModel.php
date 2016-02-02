<?php

abstract class AbstractModel
{
    /**
     * @var DB
     */
    private static $_db;
    protected static $_table = 'unknown';
    protected $data = [];

    public static function init()
    {
        self::$_db = DB::getInstance();
    }

    public function __set($key, $val)
    {
        $this->data[$key] = $val;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public static function getAll()
    {
        return self::$_db->getObjects('SELECT * FROM ' . static::$_table);
    }

    public static function get($id)
    {
        return self::$_db->getObjects_wp('SELECT * FROM ' . static::$_table .' WHERE id = ?', [$id])[0];
    }

    public static function removeAll()
    {
        // TODO: remove all news
    }

    public static function remove($id)
    {
        $db = self::$_db;
        $q = 'DELETE FROM ' . static::$_table . ' WHERE id = ?';
        $db->query_wp($q, [$id]);
    }

    public function save()
    {
        $db = self::$_db;
        try {
            $q = 'INSERT INTO ' . static::$_table .
                '(' . implode(',', array_keys($this->data)) .')
                VALUES
                (' . str_pad('?', count($this->data) * 2 - 1, ',?') . ')';
            $db->query_wp($q, array_values($this->data));

        } catch (PDOException $e) {
            echo 'INSERT ERROR: ', $e->getMessage();
        }
    }

    public function update()
    {
        $db = self::$_db;
        $q = 'UPDATE ' . static::$_table .
            'SET ' . implode('=?,', array_keys($this->data)) . '=?' .
            ' WHERE id=:id';
        $data = array_values($this->data);

        $db->query_wp($q, $data);
    }

    public function delete()
    {
        self::remove($this->id);
    }
}
