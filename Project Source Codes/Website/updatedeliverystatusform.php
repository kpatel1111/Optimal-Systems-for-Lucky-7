<?php
//This class allows the driver to enter the new delivery status along with the orderid.
		$conn = mysqli_connect("localhost", "root", "", "cosc412");
		session_start();
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
$orderid = $_GET['orderid']; // get id through query string ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lucky 7 - Update Delivery Status</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="full-page">
    <div style="height:fit-content; margin-top: 120px;" class="form-box">
	<center>
		<h1>Update Delivery Status</h1>
		<form action="updatedeliverystatus.php" method="post">
		
<p style="color:black;">Order ID: <?php echo $orderid;?></p>	
<p>
                <label for="orderid"></label>
                <input type="text" class="input-field"placeholder="Confirm Order ID"name="orderid" id="orderid"required>
                </p>
            <p>
                <label for="status"></label>
                <input type="text" class="input-field"placeholder="Enter New Delivery Status"name="status" id="status"required>
                </p>

			<button style="margin-top: 20px;" type="submit" value="Submit">Submit</button>
		</form>
	</center>
    </div>
	
    </div>
	
</body>
</html>

