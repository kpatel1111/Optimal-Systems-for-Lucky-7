<?php
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		//Storing user input into different variables.
		$pictureName = $_REQUEST['pictureName'];
		$productName = $_REQUEST['productName'];
		$serialNumber = $_REQUEST['serialNumber'];
		$type = $_REQUEST['type'];
		$quantity = $_REQUEST['quantity'];
		$price = $_REQUEST['price'];
		//DataBase insertion query performed.
		$sql = "INSERT INTO products VALUES ('$pictureName','$serialNumber','$productName','$type','$quantity','$price')"; 

		if(mysqli_query($conn, $sql)){
			header('location: addinventoryproduct.php');
		} else{
			header('location: addinventoryproduct.php');
		}
		
		// Close connection
		mysqli_close($conn);
?>
