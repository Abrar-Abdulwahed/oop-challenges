<?php
    require_once 'MysqliConnect.php';
    class CRUD extends MysqliConnect{

        public function createRecord($table, $cols, $values)
		{
			$this->insert($table, $cols, $values);
			if ($this->execute()) {
			    header("Location: $table.php");
			}else{
			    echo "Something Went Wrong. Please try again!";
			}
		}
        public function readAllData($table){
		    $this->query('*', $table);
            $this->execute();
            if ($this->rowCount() > 0) {
                $data = array();
                while ($row = $this->fetch()) {
                    $data[] = $row;
                }
                return $data;
            }
            else
                echo "No found records";
		}
        public function getRecordById($table, $targetColum, $colum, $id){
            $this->getById($table, $targetColum, $colum, $id);
            if($this->execute() and $this->rowCount() > 0){
                $catName = $this->fetch();
                return $catName[$targetColum];
            }
            else
                echo "No found records";
        }
        public function deleteRecord($table , $colum , $id){
		    $this->delete($table , $colum , $id);
            if ($this->execute() > 0) {
                header("Location: $table.php");
            }
            else
            echo "Record does not delete try again";
        }
        public function updateRecord($table , $data , $colum, $id)
		{
		    $this->update($table , $data , $colum, $id);
            $flag = $this->execute();
            if ($flag) {
                header("Location: $table.php");
            }
            else
                echo "Record does not delete try again";
		}
    }
?>