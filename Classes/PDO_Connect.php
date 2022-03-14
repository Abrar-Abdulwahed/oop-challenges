<?php

require_once 'interfaces/InterfaceDatabase.php';
class PDO_Connect{
    private $dbhost , $dbuser , $dbpass , $dbname , $charset , $stmt , $error;
    protected $conn;
    public function __construct() { 
        $this->dbhost   = "localhost";
        $this->dbuser   = "root";
        $this->dbpass   = "";
        $this->dbname   = "pdo_data";
        $this->charset  = "UTF8";

        try {
            $this->conn = 
                    new PDO(
                    "mysql:host={$this->dbhost};dbname={$this->dbname};charset={$this->charset}",
                    $this->dbuser,
                    $this->dbpass
                    );
                    
        } catch (PDOException $error) {
            $this->error = $error->getMessage();
            die($this->error);
        }
        
    }
}

?>
