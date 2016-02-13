<?php

/**
 * Class AbstractModel
 * @property $id
 */
abstract class AbstractModel
{
    /** @var DB */
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

    public function insert()
    {
        $q = 'INSERT INTO ' . static::$_table . '(' . implode(',', array_keys($this->data)) .') VALUES (?' . str_repeat(',?', count($this->data) - 1) . ')';
        return self::$_db->query_wp($q, array_values($this->data));
    }

    public function update()
    {
        $arr = array_keys($this->data);
        array_pop($arr);
        $q /** @lang SQL */= 'UPDATE ' . static::$_table . ' SET ' . implode('=?,', $arr) . '=? WHERE id=?';
        $data = array_values($this->data);
        self::$_db->query_wp($q, $data);
    }

    public function save()
    {
        if (!$this->insert()) {
            $this->update();
        }
    }

    public function delete()
    {
        self::remove($this->id);
    }
}
