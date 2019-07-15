<?php
class DBClass {

    private $host = "remotemysql.com";
    private $username = "1pAKCmGk6K";
    private $password = "hmOwRBp5Ep";
    private $database = "1pAKCmGk6K";

    public $connection;

    // get the database connection
    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>