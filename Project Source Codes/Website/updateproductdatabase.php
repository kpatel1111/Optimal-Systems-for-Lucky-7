<?php
//This class processes the inventory item update request to the database.

		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}

		$serialNumber = $_REQUEST['serialNumber'];
		$quantity = $_REQUEST['quantity'];
		$price = $_REQUEST['price'];

		$sql = "UPDATE products SET quantity='$quantity', price='$price' WHERE serialNumber='$serialNumber'"; 

		if(mysqli_query($conn, $sql)){
			header('location: updateinventoryproduct.php');
		} else{
			header('location: updateinventoryproduct.php');
		}
		
		// Close connection
		mysqli_close($conn);
?>
