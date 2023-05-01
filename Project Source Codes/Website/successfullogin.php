<?php
//This class re-directs the user to the successful login page after the credentials are correctly verified from the existing database.
$conn = mysqli_connect("localhost", "root", "", "cosc412");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lucky 7 - Account Login Status</title>
	<link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <div class="full-page">
	<div class="header">
		<h2>Login Status</h2>
	</div>
	<div class="content">

<?php if (isset($_SESSION['firstName'])) : ?>
<p>Welcome <strong><?php echo $_SESSION['firstName']; ?></p>
<p></strong>Login Successful</p>
<p>What would you like to do:</p>
<p><a href="index.php" style="color: red;">Enter Home Page</a></p>
<p><a href="logout.php" style="color: red;">Logout</a></p>
<?php endif ?>
</div>
</body>
</html>
