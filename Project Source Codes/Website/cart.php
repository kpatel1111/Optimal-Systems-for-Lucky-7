<?php
//This class is used to add inventory items to the shopping cart everytime the user clicks on the add-to-cart-button.
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		session_start();
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
$quantity=$_POST['quantity'];
$serialNumber = $_GET['serialNumber']; // get id through query string

$sql = "SELECT *  FROM products WHERE serialNumber = '$serialNumber'";
$result=mysqli_query($conn, $sql);
if($result){
    $rows=mysqli_fetch_assoc($result);
	$price=$quantity*$rows['price'];
    $sql="INSERT INTO usercart VALUES ('$_SESSION[email]','$rows[picture]','$serialNumber','$rows[productName]','$quantity','$price')";
    $result=mysqli_query($conn, $sql);
    if($result){
       header('location: cartform.php');
    }
}

mysqli_close($conn);
?>