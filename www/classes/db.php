<?php

class DB
{
    private $_dbh;
    /**
     * @var PDOStatement
     */
    private $_stmt;

    public function __construct($dbname = 'edu', $user = 'root', $pass = 'drol21755')
    {
        $DEFAULT_DB_DRIVER = 'mysql';
        $DEFAULT_HOST = 'localhost';
        $dsn = $DEFAULT_DB_DRIVER . ':host=' . $DEFAULT_HOST . ';dbname=' . $dbname;
        try {
            $this->_dbh = new PDO($dsn, $user, $pass);
            //array(PDO::ATTR_PERSISTENT => $persistent)
            $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//            $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);
        } catch (PDOException $e) {
            echo '<strong>FAILED TO GET DB HANDLE: </strong>' . $e->getMessage();
        }
    }

    public function query($query)
    {
        return $this->_stmt = $this->_dbh->query($query);
    }

    public function run($query, $params = [])
    {
        return $this->_stmt = $this->_dbh->prepare($query)->execute($params);
    }

    /**
     * @param $name
     * @param $arguments
     * @return PDOStatement
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->_stmt, $name), $arguments);
    }
}
