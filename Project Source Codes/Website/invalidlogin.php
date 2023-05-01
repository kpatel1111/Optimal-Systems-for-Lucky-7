<?php
//This class displays the invalid login status page to the user if they enter incorrect credentials.
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lucky 7 - Account Login Status</title>
	<link rel="stylesheet" type="text/css"
					href="style3.css">
</head>
<body>
    <div class="full-page">
	<div class="header1">
		<h2>Login Status</h2>
	</div>
	<div class="content1">
<p>Unsuccessful Login Attempt</p>
<p><a href="accountloginform.html" style="color: blue;">Log In Again</a></p>
</div>
</body>
</html>
