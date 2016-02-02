<?php

/***
 * Class DB
 */
class DB
{
    private $_dbh;
    private $_stmt;
    private static $_instance = null;

    private function __construct()
    {
        try {
            $this->_dbh = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            //$this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);
        } catch (PDOException $e) {
            echo '<strong>FAILED TO GET DB HANDLE: </strong>' . $e->getMessage();
        }
    }

    private function __clone() {}

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->_stmt, $name), $arguments);
    }

    /***
     * @return DB|PDOStatement|null
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function prepare($query)
    {
        $this->_stmt = $this->_dbh->prepare($query);
    }

    public function query_wp($query, $params)
    {
        $stmt = $this->_dbh->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function getObjects($query)
    {
        return $this->_dbh->query($query)->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }

    public function getObjects_wp($query, $params)
    {
        return $this->query_wp($query, $params)->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }
}
