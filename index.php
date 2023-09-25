<?php 
// Include the database file to establish a database connection
include('config/database.php');

// Include custom functions, such as 'prevent_access()'
include('include/functions.php');

// Check and prevent access to this page for logged-in users
prevent_access();

// Check if the 'login' form field has been submitted
if(isset($_POST['login'])){
    // Extract form fields into variables
    extract($_POST);

    // Check if username and password are not empty
    if (!empty($username) && !empty($password)){
        
        // Hash the password for comparison with the database
        $pass = md5($password);

        // Construct an SQL query to select user data based on provided username and hashed password
        $select = "select * from userstb where name = '$username' AND password='$pass'";
        
        // Execute the SQL query
        $select_query = $sql_connection->query($select);

        // Check if a matching record is found in the database
        if ($select_query->num_rows > 0){

            // Fetch user data from the database
            $_SESSION['user_data'] = mysqli_fetch_assoc($select_query);

            // Check the user's role and set session variables accordingly
            if ($_SESSION['user_data']['user_role'] === 'admin'){
                $_SESSION['is_admin'] = true;
                $_SESSION['is_member'] = true;
            } elseif ($_SESSION['user_data']['user_role'] === 'member'){
                $_SESSION['is_member'] = true;
            }
            
            // Set a session variable to indicate that the user is logged in
            $_SESSION['user_is_logged_in'] = true;

            // Redirect the user to the 'member.php' page
            header('location: member.php');

            // Set a success message in the session
            $_SESSION['success'] = "Welcome " . $_SESSION['user_data']['name'] . " &#128578;";

            // Exit to prevent further code execution
            exit;
        } else {
            // If no match is found, set an error message in the session
            $_SESSION['error'] = "Invalid User";
        }
    } else {
        // If either username or password is empty, set an error message in the session
        $_SESSION['error'] = "Please Fill All Required Fields";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>

 <body> 
    
 
 <!-- partial:index.partial.html --> 

  <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 

   <div class="signin"> 

    <div class="content"> 

     <h2>Sign In</h2> 

    <form action="index.php" class="form" method="post">

      <div class="inputBox"> 

       <input type="text" name="username" > <i class="required">Username</i> 

      </div> 

      <div class="inputBox"> 

       <input type="password" name="password" > <i class="required">Password</i> 

      </div> 

      <div class="links"> <a href="#"></a> <a href="signup.php">Signup</a> 

      </div> 

      <div class="inputBox"> 

       <input type="submit" name="login" value="Login"> 

      </div>
      
      <div class="inputBox"> 

    <?php   include("include/alerts.php") ?>

      </div>

    </form>

    </div> 

   </div> 

  </section> <!-- partial --> 

 </body>

</html>
</body>
</html>