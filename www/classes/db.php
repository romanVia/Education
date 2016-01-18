<?php

class DB
{
    private $dbh;

    public function __construct($driver = 'mysql', $host = 'localhost', $dbname = 'edu', $user = 'root', $pass = 'drol21755')
    {
        try {
            $this->dbh = new PDO($driver.':host='.$host.';dbname='.$dbname, $user, $pass);
            //array(PDO::ATTR_PERSISTENT => $persistent)
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Failed to get DB handle: '.$e->getMessage();
        }
    }

    public function query($query)
    {
        return $this->dbh->query($query, 'News');
    }

    public function execute($query, $class = 'stdClass')
    {
        $result = $this->dbh->prepare($query);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_CLASS, $class);
        if (count($result)) {
            return $result;
        } else {
            return false;
        }
    }
}
