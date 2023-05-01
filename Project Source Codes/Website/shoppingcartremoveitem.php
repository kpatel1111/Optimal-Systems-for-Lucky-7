<?php
//This class is activated when the user clicks on the remove link from the shopping cart page. So, this class removes that saved item from the user's cart.
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		session_start();
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}

$productName = $_GET['productName']; // get id through query string

$sql = "DELETE from usercart WHERE productName = '$productName' AND email='$_SESSION[email]'"; // delete query

if(mysqli_query($conn, $sql)){
header('location: cartform.php');
exit();
}

mysqli_close($conn);
?>