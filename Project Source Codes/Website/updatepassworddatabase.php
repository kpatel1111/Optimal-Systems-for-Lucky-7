<?php 
//This class is used to verify the login credentials, and update the new password.
$conn = mysqli_connect("localhost", "root", "", "cosc412");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
		$newPassword = $_REQUEST['newPassword'];
		$hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
		$email = $_REQUEST['email'];
        $oldPassword = $_REQUEST['oldPassword'];

		$sql = "SELECT * from users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        $hash=$row['password'];
        $verify=password_verify($oldPassword,$hash);

		if($verify){
			$sql = "UPDATE users SET password='$hashPassword' WHERE email='$email'";
			if(mysqli_query($conn, $sql)){
				header('location: useraccountpage.php');
				exit();
			}
		}
		else{
			echo "Unable to process your request.";
		}
		
		// Close connection
		mysqli_close($conn);
?>
