<?php

// Include the 'config/database.php' file for database-related functionality.
include('config/database.php');

// Set the 'user_is_logged_in' session variable to false, indicating the user is not logged in.
$_SESSION['user_is_logged_in'] = false;
$_SESSION['is_admin'] = false;
$_SESSION['is_member'] = false;

session_destroy();
// Redirect the user to the 'index.php' page.
header('location: index.php');

?>