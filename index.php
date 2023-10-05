<?php 
// Include the database file to establish a database connection
include('config/database.php');
include('config/config.php');
// Include custom functions, such as 'access_deny()'
include('include/models/functions.php');


// Check and prevent access to this page for logged-in users
prevent_access();

deleteexpiredotp($sql_connection);
// Check if the 'login' form field has been submitted
if(isset($_POST['login'])){
    // Extract form fields into variables
    extract($_POST);

    // Check if username and password are not empty
    if (!empty($username) && !empty($password)){
        
        // Construct an SQL query to select user data based on provided username and hashed password
        $select = "select * from userstb where name = '$username'";

        // Execute the SQL query
        $select_query = $sql_connection->query($select);
        $result1 = mysqli_fetch_assoc($select_query);
        $pass1= $result1['password'];
        $passconfirm =password_verify($password,$pass1);
        if($passconfirm) {
        // Check if a matching record is found in the database
        if ($select_query->num_rows > 0){

            // Fetch user data from the database
            $_SESSION['user_data'] = $result1;

            // Check the user's role and set session variables accordingly
            if ($_SESSION['user_data']['user_role'] === 'admin'){
                $_SESSION['is_admin'] = true;
                $_SESSION['is_member'] = true;
            } elseif ($_SESSION['user_data']['user_role'] === 'member'){
                $_SESSION['is_member'] = true;
            }
            
            // Set a session variable to indicate that the user is logged in
            $_SESSION['user_is_logged_in'] = true;

            // Set a success message in the session
            $_SESSION['success'] = "Welcome " . $_SESSION['user_data']['name'] . " &#128578;";

            // Redirect the user to the 'member.php' page
            header('location: member.php');



            // Exit to prevent further code execution
            exit;
        } }
        else {
            // If no match is found, set an error message in the session
            $_SESSION['error'] = "Invalid User";
        }
    } else {
        // If either username or password is empty, set an error message in the session
        $_SESSION['error'] = "Please Fill All Required Fields";
    }
}
?>



<?php   include("include/templates/header.php") ?>
    
 
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

      <div class="links"> 
        <a href="forget_password.php">Forgot Password</a> 
        <a href="signup.php">Signup</a> 
      </div> 

      <div class="inputBox"> 

       <input type="submit" name="login" value="Login"> 

      </div>
      
      <div class="inputBox"> 

    <?php   include("include/models/alerts.php") ?>

      </div>

    </form>

    </div> 

   </div> 

  </section> <!-- partial --> 

  <?php   include("include/templates/footer.php") ?>