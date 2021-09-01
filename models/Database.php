<?php

class Database
{

    private $dbname = 'hospitalE2N';
    private $username = 'root';
    private $password = '';

    protected function connectDatabase()
    {
        try {
            $database = new PDO("mysql:host=localhost;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            // DEBUG MODE //////////////////////////////
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // DEBUG MODE //////////////////////////////
            return $database;
        } catch (PDOException $errorMessage) {
            die('error : ' . $errorMessage->getMessage());
        }
    }
}
