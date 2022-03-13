<?php

	class Category extends MysqliConnect
	{
		// Insert category data into customer table
		public function insert($cols, $values)
		{
			$query="INSERT INTO category($cols) VALUES($values)";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location: Category.php");
			}else{
			    echo "Something Went Wrong. Please try again!";
			}
		}

        // Fetch category records for show listing
		public function displayData()
		{
		    $query = "SELECT * FROM category";
		    $result = $this->con->query($query);
		if ($result->num_rows > 0) {
		    $data = array();
		    while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			 return $data;
		    }else{
			 echo "No found records";
		    }
		}

		public function edit($set, $where)
		{

			$query = "UPDATE category SET $set WHERE $where";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location: category.php");
			}else{
			    echo "Registration updated failed try again!";
			}
			
		}
        // Delete category data from category table
		public function delete($id){
		    $query = "DELETE FROM category WHERE ID = '$id'";
		    $sql = $this->con->query($query);
		if ($sql==true) {
			header("Location: category.php");
		}else{
			echo "Record does not delete try again";
		    }
		}

	}
      
  
?>