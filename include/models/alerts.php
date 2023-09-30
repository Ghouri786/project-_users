<?php

// Use the super global $_SESSION variable to display success and error messages.
// Include this code where you want to print messages.

// Check if a success message is set in the session, and if so, display it
if(isset($_SESSION['success'])){
    echo '<div class="success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']); // Remove the success message from the session to avoid displaying it again.
}

// Check if an error message is set in the session, and if so, display it
if(isset($_SESSION['error'])){
    echo '<div class="error">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']); // Remove the error message from the session to avoid displaying it again.
}



?>