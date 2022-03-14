<?php
    require_once 'PDO_Connect.php';
    class CRUD extends PDO_Connect implements PDO_Intserface{
        private $stmt;
        public function createRecord($table, $cols, $values)
		{
			$this->stmt = $this->conn->prepare("INSERT INTO `$table` ($colums) VALUES ($values)");
            $this->stmt->execute();		
		}
        public function getAllRecords($table){
            $this->stmt = $this->conn->prepare("SELECT * FROM `$table`");
            $this->stmt->execute();
            if ($this->stmt->rowCount() > 0) {
                $data = array();
                $data = $this->stmt->fetchAll();
                return $data;
            }
            else
                echo "No found records";
		}
        public function getRecordById($table, $targetColum, $other){
            $this->stmt = $this->conn->prepare("SELECT $targetColum FROM `$table` $other");
            $this->stmt->execute();
            if($this->stmt->rowCount() > 0){
                return $this->stmt->fetch();
            }
            else
                echo "No found records";
        }
        public function deleteRecordById($table , $colum , $id){
            $this->stmt = $this->conn->prepare("DELETE FROM `$table` WHERE `$colum` = $id");
            $this->stmt->execute();
        }
        public function updateRecordById($table , $data , $colum, $id)
		{
            $this->stmt = $this->conn->prepare("UPDATE `$table` SET $data WHERE `$colum` = $id");
            $this->stmt->execute();
		}
    }
?>