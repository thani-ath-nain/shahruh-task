<?php

// Initialize the session
session_start();

// Check if user is logged in. If not then redirect to login page
if (!isset($_SESSION["loggedin"]) ||  $_SESSION["loggedin"] !== true) {
    /**
     * The second special case is the "Location:" header. Not only does it send this header 
     * back to the browser, but it also returns a REDIRECT (302) status code to the browser 
     * unless the 201 or a 3xx status code has already been set.
     */
    header("location: login.php");  // header — Send a raw HTTP header
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>

</head>

<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <a href="crud.php" class="btn btn-primary">Admin Panel</a>
    </p>
</body>

</html>