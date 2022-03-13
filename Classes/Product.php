<?php
	class Product{
		private $servername = "localhost";
		private $username   = "root";
		private $password   = "";
		private $database   = "codingAcademy";
		private  $con;


		// Database Connection 
		public function __construct()
		{
		    $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
		    if(mysqli_connect_error()) {
			 trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
		    }else{
			return $this->con;
		    }
		}

		// Insert product data into product table
		public function insertData($post)
		{
			$productname = $this->con->real_escape_string($_POST['productname']);
			$productprice=$this->con->real_escape_string($_POST['productprice']);
            if($_FILES['productimage']['name']){
             move_uploaded_file($_FILES['productimage']['tmp_name'], "image/".$_FILES['productimage']['name']);
              $img="image/".$_FILES['productimage']['name'];
               }
   
               $categoryname=$this->con->real_escape_string($_POST['category']);


			$query="insert into product(product_id,product_name,product_price,product_image,category_id) value(null,'$productname', '$productprice','$img','$categoryname' )";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:index.php?msg1=insert");
			}else{
			    echo "Registration failed try again!";
			}
        }
    
        // Fetch category records for show listing
		public function displayData()
		{
		    $query = "SELECT * FROM product";
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
        ////////////////// display product in category
        	public function displayProData($cat)
		{
            
             $query = "select category_name from category where category_id= $cat";
		    // $query = "select category_name from category where category_id= $cat")->fetch_object()->category_name";
		    $result = $this->con->query($query)->fetch_object()->category_name;
		if ($result) {
		   
			 return $result;
		    }else{
			 echo "No found records";
		    }
            
        }

        // Fetch single data for edit from customer table
		public function displyaRecordById($id)
		{
		    $query = "SELECT * FROM product WHERE product_id = '$id'";
		    $result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		    }else{
			echo "Record not found";
		    }
		}
        	// Update category data into category table
		public function updateRecord($postData)
		{
		    $productname=$this->con->real_escape_string($_POST['productname']);
            $productprice=$this->con->real_escape_string($_POST['productprice']);
            if($_FILES['productimage']['name']){
             move_uploaded_file($_FILES['productimage']['tmp_name'], "image/".$_FILES['productimage']['name']);
              $img="image/".$_FILES['productimage']['name'];
             }
              else{
            $img=$this->con->real_escape_string($_POST['img1']);
            }
  
             $categoryname=$this->con->real_escape_string($_POST['category']);
		    $id = $this->con->real_escape_string($_POST['id']);
		if (!empty($id) && !empty($postData)) {
			$query = "update product set product_name='$productname',product_price='$productprice',product_image='$img',category_id ='$categoryname' where product_id='$eid'";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:index.php?msg2=update");
			}else{
			    echo "Registration updated failed try again!";
			}
		    }
			
		}
        public function displayCategorypro()
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

        	// Delete category data from category table
		public function deleteRecord($id)
		{
		    $query = "DELETE FROM product WHERE product_id = '$id'";
		    $sql = $this->con->query($query);
		if ($sql==true) {
			header("Location:index.php?msg3=delete");
		}else{
			echo "Record does not delete try again";
		    }
		}
        
    }
	
?>