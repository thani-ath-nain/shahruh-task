<?php
if (isset($_COOKIE['usernamecookie'])) {
    unset($_COOKIE['usernamecookie']);
    setcookie('usernamecookie', null, -1, '/');
}
session_start(); // Initialize the session


$_SESSION = array(); // Unset all of the session variables


session_destroy(); // Destroy the session.


header("location: login.php"); // Redirect to login page
exit;
