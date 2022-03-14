<?php
class MysqliConnect {
    private $dbhost, $dbuser, $dbpass, $dbname;
    public function __construct() {
        $this->dbhost = "localhost";
        $this->dbuser = "root";
        $this->dbpass = "";
        $this->dbname = "codingAcademy";
        $this->conn();
    }

    protected function conn(){
        $this->conn = mysqli_connect($this->dbhost, $this->dbuser , $this->dbpass , $this->dbname);
                      mysqli_set_charset($this->conn, 'utf8');
        try{
            $this->dbh = $this->conn;
        } catch (Exception $e) {
            die($this->error = $e->getMessage());
        }
        return $this->dbh;
    }
    
    public function query($colum , $table , $other = null) {
        $this->stmt = mysqli_query($this->conn(), "SELECT {$colum} FROM `{$table}` {$other}");
    }
    public function execute() {
        return $this->stmt;
    }
    public function fetch() {
        return mysqli_fetch_array($this->stmt);
    }
    public function rowCount() {
        return mysqli_num_rows($this->stmt);
    }

    public function insert($table , $colum , $value) {
        $this->stmt = mysqli_query($this->conn(), "INSERT INTO `{$table}` ({$colum}) VALUES ({$value})");
    }
    public function update($table , $data , $colum, $id , $other = null){
        $this->stmt = mysqli_query($this->conn(), "UPDATE `{$table}` SET {$data} WHERE `{$colum}` = '{$id}' {$other}");
    }
    public function delete($table , $colum , $id , $other = null) {
        $this->stmt = mysqli_query($this->conn(), "DELETE FROM `{$table}` WHERE `{$colum}` = '{$id}' {$other}");
    }
    public function getById($table, $targetColum, $colum, $id, $other = null){
        $this->stmt = mysqli_query($this->conn(), "SELECT {$targetColum} FROM `{$table}` WHERE `{$colum}` = '{$id}' {$other}");
    }
}
