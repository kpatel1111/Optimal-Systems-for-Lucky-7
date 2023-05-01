<?php
//This class is utilized to take user input from the account registration form, and store the data into the database tables accordingly.
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		session_start();
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
		//Taking user input and storing into variables.
		$firstName = $_REQUEST['firstName'];
		$lastName = $_REQUEST['lastName'];
		$phoneNumber = $_REQUEST['phoneNumber'];
		$address = $_REQUEST['address'];
		$cardNumber = $_REQUEST['cardNumber'];
		$cardCvv = $_REQUEST['cardCvv'];
		$email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
		$type= $_REQUEST['type'];


		$sql = "INSERT INTO users VALUES ('$email','$hashPassword')"; 
		if(mysqli_query($conn, $sql)){
			$sql = "INSERT INTO userdata VALUES ('$email','$firstName','$lastName','$address','$phoneNumber','$cardNumber','$cardCvv','$type')";
			if(mysqli_query($conn,$sql)){
			$sql = "SELECT * FROM userdata WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
			$row=mysqli_fetch_assoc($result);
			$_SESSION["lastName"]=$row["lastName"];
            $_SESSION["firstName"]=$row["firstName"];
			$_SESSION["email"]=$row["email"];
			$_SESSION["type"]=$row["type"];
			header('location: successfullogin.php');
			} else {
				header('location: accountregistrationform.html');
		}
	} else {
		header('location: accountregistrationform.html');
}
		
		// Close connection
		mysqli_close($conn);
?>
