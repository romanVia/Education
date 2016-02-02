<?php

abstract class AbstractModel
{
    /**
     * @var DB
     */
    private $_db;
    protected static $_table = 'unknown';
    protected $data = [];

    public function __set($key, $val)
    {
        $this->data[$key] = $val;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    private static function query($query) { return self::$_db->query($query); }
    private static function execute($query, $params) { self::$_db->run($query, $params); }
    private function getObjects() { return $this->_db->fetchAll(PDO::FETCH_CLASS, get_called_class()); }

    public static function getAll()
    {
        self::query('SELECT * FROM ' . static::$_table);
        return self::getObjects();
    }

    public static function get($id)
    {
        self::execute('SELECT * FROM ' . static::$_table .' WHERE id = ?', [$id]);
        return self::getObjects()[0];
    }

    public function save()
    {
        $db = self::$_db;
        try {
            $q = 'INSERT INTO ' . static::$_table .
                '(' . implode(',', array_keys($this->data)) .')
                VALUES
                (' . str_pad('?', count($this->data) * 2 - 1, ',?') . ')';
            $db->run($q, array_values($this->data));

        } catch (PDOException $e) {
            echo 'INSERT ERROR: ', $e->getMessage();
        }
    }

    public function update()
    {
        die;
        $db = self::$_db;
        $q = 'UPDATE ' . static::$_table .
            'SET ' . implode('=?,', array_keys($this->data)) . '=?' .
            ' WHERE id=:id';
        $data = array_values($this->data);

        $db->run($q, $data);
    }

    public static function remove($id)
    {
        $db = self::$_db;
        $q = 'DELETE FROM ' . static::$_table . ' WHERE id = ?';
        $db->run($q, [$id]);
    }

    public function delete()
    {
        self::remove($this->id);
    }
}
