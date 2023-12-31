<?php
// Check if the user is logged in by verifying the 'user_is_logged_in' session variable
function access_deny(){
    if(isset($_SESSION['user_is_logged_in']) && $_SESSION['user_is_logged_in'] === true){
        // If the user is logged in, return true (presumably indicating a successful login)
        return true;
    } else {
        // If the user is not logged in, redirect them to the 'index.php' page
        header('location: index.php');
    }
}

// Function to prevent access to certain pages like index.php & sign-up.php when a user is already logged in
function prevent_access(){
    if(isset($_SESSION['user_is_logged_in']) && $_SESSION['user_is_logged_in'] === true){
        // If the user is logged in, redirect them to 'member.php'
        header('location: member.php');
    }
}

// Function to restrict access to admin-related functionality for non-admin users
function admin_access(){
    // Check if the user is logged in, and if their role is not 'admin'
    if(isset($_SESSION['user_is_logged_in']) && $_SESSION['user_is_logged_in'] === true && $_SESSION['user_data']['user_role'] !== 'admin'){
        // If the user is logged in but not an admin, redirect them to 'member.php'
        header('location: member.php');
        exit; // Exit to stop further script execution
    }
}



function deleteexpiredotp($sql_connection){
// OTP delete from database funtionality when otp expired
$sqlt = "SELECT * FROM reset_pass where NOW() > expired_at";
$queryt = $sql_connection->query($sqlt);
while($result =mysqli_fetch_assoc($queryt)){
    $user_id = $result['user_id'];
    $sql3 = "delete from reset_pass where user_id= $user_id";
    $query3 =$sql_connection->query($sql3);
}

}
?>
