<?php
//This class is used to take the serial number the user enters of an inventory item, and performs an SQL deletion query to remove that item from the database.
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
		$serialNumber = $_REQUEST['serialNumber'];
		$sql = "DELETE FROM products WHERE serialNumber='$serialNumber'"; 

		if(mysqli_query($conn, $sql)){
			header('location: deleteinventoryproduct.php');
		} else{
			header('location: deleteinventoryproduct.php');
		}
		
		// Close connection
		mysqli_close($conn);
?>
