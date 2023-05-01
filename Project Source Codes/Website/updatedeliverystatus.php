<?php
//This class allows the driver to update the new delivery status in the database systems.
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		session_start();
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}

$status = $_REQUEST['status'];
$orderid = $_REQUEST['orderid']; // get id through query string

$sql = "UPDATE driverdata SET status='$status' WHERE orderid='$orderid'"; // update query

if(mysqli_query($conn, $sql)){
header('location: driverdeliverydata.php');
exit();
}

mysqli_close($conn);
?>