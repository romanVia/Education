<?php

class DB
{
    private $dbh;

    public function __construct($driver, $host, $dbname, $user, $pass)
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
        return $this->dbh->query($query);
    }

    public function execute($query)
    {
        $result = $this->dbh->prepare($query);
        $result->execute();
        $result = $result->fetchAll();
        if (count($result)) {
            return $result;
        } else {
            return false;
        }
    }
}