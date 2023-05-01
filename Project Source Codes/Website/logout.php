<?php
//This class is used to erase all the data stored in the global session variables, and logout the user from their accounts.
session_start();
session_destroy();
header("Location:accountloginform.html");
?>