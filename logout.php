<?php

session_start(); // Initialize the session

setcookie("usernamecookie" , "" , time() - 3600);
setcookie("passwordcookie" , "" , time() - 3600);


$_SESSION = array(); // Unset all of the session variables


session_destroy(); // Destroy the session.


header("location: login.php"); // Redirect to login page
exit;
