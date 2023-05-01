<?php
//This class displays the user profile card to the user. This card includes information like name, address, and phone number.
 $conn = mysqli_connect("localhost", "root", "", "cosc412");
 
 session_start();
 function mask_card_details($card){
  return str_repeat("*", 12) . substr($card,-4);
 }
 function mask_card_cvv($card){
  return str_repeat("*", 4) . substr($card,-1);
 }
?>
<!DOCTYPE html>
<html>
<head>
 <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
 <link rel="stylesheet" type="text/css" href="style17.css">
<title>Lucky 7 - Profile Card</title>
 <link rel="stylesheet"
          href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>

<!--h1 align='center'>Welcome <?php echo $loggedin_session; ?>,</h1-->
<?php
$sql="SELECT * FROM userdata where email='$_SESSION[email]'";
$result=mysqli_query($conn,$sql);
?>
<?php
while($rows=mysqli_fetch_array($result)){
?>
<body>
    <div class="full-page">
    <div class="form-box2">
	<center>
  <h3><a href="index.php" style="color:red;">Home Page</a></h3>
		<h1>Profile Card</h1>
		
<p><b>First Name:</b> <?php echo $rows['firstName']?></p>
<p><b>Last Name:</b> <?php echo $rows['lastName']?></p>
<p><b>Home Address:</b> <?php echo $rows['address']?></p>
<p><b>Phone Number:</b> <?php echo $rows['phoneNumber']?></p>
<p><b>Card Number:</b> <?php echo mask_card_details($rows['cardNumber'])?></p>
<p><b>Card CVV Code:</b> <?php echo mask_card_cvv($rows['cardCvv'])?></p>
<p><b>Account Type:</b> <?php echo $rows['type']?></p>
<p><b>Email Address:</b> <?php echo $rows['email']?></p>

<div class="dropdown">
  <button class="dropbtn">Update Record</button>
  <div class="dropdown-content">
    <a href="updatenameform.html">Update Name</a>
    <a href="updateaddressform.html">Update Address</a>
    <a href="updatephoneform.html">Update Phone</a>
    <a href="updatecardform.html">Update Card</a>
    <a href="updatepasswordform.html">Update Password</a>
  </div>
</div>
	</center>
    </div>
	
    </div>
<?php 
// close while loop 
}
?>

</body>
</html>