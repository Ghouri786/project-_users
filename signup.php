<?php 


// Include the database file to establish a database connection
include('config/database.php');

// Include custom functions, such as 'prevent_access()'
include('include/functions.php');

// Check and prevent access to this page for logged-in users
prevent_access();

// Insert data from the 'sign-up form' into the database when the submit button is clicked
if(isset($_POST['submit'])){
    // Extract form fields into variables
    extract($_POST);

    // Check if validation fields are not empty
    if (!empty ($username) && !empty ($password) && !empty ($email) ){
        // Validation to ensure the same user is not already registered in the database
        $select = "SELECT * FROM userstb WHERE name = '$username' OR email = '$email'";
        $select_query = $sql_connection->query($select);

        if($select_query->num_rows > 0){
            // If a user with the same username or email already exists, set an error message
            $_SESSION['error'] = "Username or Email Already Registered";
        }else{
            // Hash the password for security
            $hashed_password = password_hash($password , PASSWORD_DEFAULT);

            // Check if an image file was uploaded
            if(isset($_FILES['img']) && $_FILES['img']['error'] == 0){
                $imgpath = $username . "_" . $_FILES['img']['name'];
                $uploadDirectory = 'uploads/';
                if (!file_exists($uploadDirectory)) {
                    mkdir($uploadDirectory, 0755, true);
                }
                $uploadimg = $uploadDirectory . $imgpath;
                $uploaded = move_uploaded_file($_FILES['img']['tmp_name'], $uploadimg);
            }

                // Insert user data into the database
                $insert = "INSERT INTO userstb (name, password, email, img) VALUES ('$username','$hashed_password','$email','$uploadimg')";
                $insert_query = $sql_connection->query($insert);
    
                // Show a success message and redirect to 'index.php' if user is successfully registered
                if($insert_query){
                    $_SESSION['success'] = "Registered Account Successfully";
                    header('location: index.php');
                    exit;
                }
            }
        }else{
            // If any required fields are empty, set an error message
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

     <h2>Sign Up</h2> 

    <form action="signup.php" class="form" method="post" enctype="multipart/form-data">

      <div class="inputBox"> 

       <input type="text" name="username"  > <i class="required">Username</i> 

      </div> 

      <div class="inputBox"> 

       <input type="password" name="password" > <i class="required">Password</i> 

      </div> 

      <div class="inputBox"> 

       <input type="Email" name="email" > <i class="required">Email</i> 

      </div>
     
      <div class="inputBox flex"> 
<label for="Profile Pic" class="profileimg">Profile Pic</label>

       <input type="file" name="img" accept=".jpg, .jpeg, .png" />

      </div>

      <div class="links" > <a href="#"></a> <a href="index.php">Login</a> 

      </div> 

      <div class="inputBox"> 

       <input type="submit" name="submit" value="Sign Up"> 

      </div>

      <div class="inputBox"> 

    <?php   include('include/alerts.php') ?>

     </div>

    </form>

    </div> 

   </div> 

  </section> <!-- partial --> 

 </body>

</html>