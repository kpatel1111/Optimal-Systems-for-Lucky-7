<?php
//This class is utilized to verify existing user credentials, and show the content accordingly.
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
        session_start();

		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
        if(isset($_POST['email']) && isset($_POST['password'])){
            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }
        }

        $email=validate($_POST['email']);
        $password=validate($_POST['password']);

        if(empty($email)){
            echo "Email is required";
        }
        if(empty($password)){
            echo "Password is required";
        }
		
		$sql = "SELECT * FROM users WHERE email='$email'";
		
        $result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        $hash=$row['password'];
        $verify=password_verify($password,$hash);
    
        if(mysqli_num_rows($result)===1){
            if($row['email']===$email && $verify){
             $sql="SELECT * from userdata WHERE email='$email'";
             $result = mysqli_query($conn, $sql);
             $row=mysqli_fetch_assoc($result);
             $_SESSION["lastName"]=$row["lastName"];
             $_SESSION["firstName"]=$row["firstName"];
             $_SESSION["email"]=$row["email"];
             $_SESSION["type"]=$row["type"];
            //Re-direct the user to the welcome page after successful login completion.
            header('location: successfullogin.php');
            } else {
                header('location: invalidlogin.php');
            }
        } else{
            //Re-direct the user to the invalid login page.
            header('location: invalidlogin.php');
        }
		// Close connection
		mysqli_close($conn);
?>
