<?php 
//This class is used to verify the login credentials, and update the new phone number.
$conn = mysqli_connect("localhost", "root", "", "cosc412");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
		$phoneNumber = $_REQUEST['phoneNumber'];
		$email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

		$sql = "SELECT * from users WHERE email='$email'";
		if(mysqli_query($conn,$sql)){
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		$hash=$row['password'];
        $verify=password_verify($password,$hash);
		if($verify){
			$sql="UPDATE userdata SET phoneNumber='$phoneNumber' WHERE email='$email'";
			$result=mysqli_query($conn,$sql);
			header('location: useraccountpage.php');
			exit();
		} else {
			echo "Password do not match.";
		}
		}else{
			echo "Email does not exist.";
		}
		
		// Close connection
		mysqli_close($conn);
?>
