<?php 
// Include the database file to establish a database connection
include('config/database.php');

// Include custom functions, such as 'access_deny()'
include('include/functions.php');

// Check if access is denied for the current user
access_deny();

// Check if the 'changeimg' form field has been submitted
if(isset($_POST['changeimg'])){
    $imgget = $_FILES['img'];

    // Construct a SQL query to retrieve user data by their ID
    $select = "SELECT * FROM userstb WHERE id=" . $_SESSION['user_data']['id'];

    // Execute the select query
    $select_query = $sql_connection->query($select);

    // Fetch the user's current data
    $select_result = mysqli_fetch_assoc($select_query);

    if (isset($imgget) && $imgget['error'] == 0){
        if (empty($select_result['img'])){
            $imgpath = $select_result['name']. "_" . $imgget['name'];
            $uploadDirectory = 'uploads/';
            if (!file_exists($uploadDirectory)){
                mkdir($uploadDirectory, 0755, true);
            }
            $imgpathsave = $uploadDirectory . $imgpath;
            $uploaded = move_uploaded_file($imgget['tmp_name'], $imgpathsave);
        }else{
            $pre_img_path = $select_result['img'];

            // Check if the previous image file exists and delete it
            if (file_exists($pre_img_path)){
                unlink($pre_img_path);
            }

            $imgpath = $select_result['name'] . "_" . $imgget['name'];
            $uploadDirectory = 'uploads/';
            if (!file_exists($uploadDirectory)){
                mkdir($uploadDirectory, 0755, true);
            }
            $imgpathsave = $uploadDirectory . $imgpath;
            $uploaded = move_uploaded_file($imgget['tmp_name'], $imgpathsave);
                    
        }

        // Construct an SQL query to update the user's profile picture path in the database
        $update = "UPDATE userstb SET img='$imgpathsave' WHERE id=" . $_SESSION['user_data']['id'];

        // Execute the SQL query to update the user's data
        $update_query = $sql_connection->query($update);

        // Construct a select query to fetch the updated user data
        $select = "SELECT * FROM userstb WHERE id=" . $_SESSION['user_data']['id'];

        // Execute the select query
        $select_query = $sql_connection->query($select);

        // Update the user_data session variable with the fetched data
        $_SESSION['user_data'] = mysqli_fetch_assoc($select_query);

        // Set a success message in the session
        $_SESSION['success'] = "Profile Pic Change Successfully";

        // Redirect to 'member.php'
        header('location: member.php');
        exit;
    }
}

// Check if the 'update' form field has been submitted
if(isset($_POST['update'])){
    // Extract form fields into variables
    extract($_POST);

    // Check if 'username' and 'email' fields are not empty
    if (!empty($username) && !empty($email)){
        // Construct a SQL query to retrieve user data by their ID
        $select = "SELECT * FROM userstb WHERE id=" . $_SESSION['user_data']['id'];

        // Execute the select query
        $select_query = $sql_connection->query($select);

        // Fetch the user's current data
        $select_result = mysqli_fetch_assoc($select_query);

        // Construct an SQL query to update user information in the database
        $update = "UPDATE userstb SET name ='$username', email='$email', address='$address', hobbies='$hobbies', job='$job', skill='$skill' WHERE id=" . $_SESSION['user_data']['id'];

        // Execute the SQL query to update the user's data
        $update_query = $sql_connection->query($update);

        // Check if the update was successful
        if ($update_query){
            // Update session data with the new values

            // Construct a select query to fetch the updated user data
            $select = "SELECT * FROM userstb WHERE id=" . $_SESSION['user_data']['id'];

            // Execute the select query
            $select_query = $sql_connection->query($select);

            // Update the user_data session variable with the fetched data
            $_SESSION['user_data'] = mysqli_fetch_assoc($select_query);

            // Set a success message in the session
            $_SESSION['success'] = "Profile Edit Successfully";

            // Redirect to 'member.php'
            header('location: member.php');
            exit;
        }
    } else {
        // If either 'username' or 'email' fields are empty, set an error message in the session
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

  <h2>Edits</h2> 

 <form action="edits.php" class="form" method="post">

   <div class="inputBox"> 

    <input type="text" name="username" value="<?php echo $_SESSION['user_data']['name'] ?>"  > <i class="required" >Username</i> 

   </div> 
 

   <div class="inputBox"> 

    <input type="Email" name="email" value="<?php echo $_SESSION['user_data']['email'] ?>" > <i class="required">Email</i> 

   </div>

   <div class="inputBox"> 

    <input type="text" name="address" value="<?php echo $_SESSION['user_data']['address'] ?>"  > <i>Address</i> 

   </div>

   <div class="inputBox"> 

    <input type="text" name="hobbies" value="<?php echo $_SESSION['user_data']['hobbies'] ?>"  > <i>Hobbies</i> 

   </div>

   <div class="inputBox"> 

    <input type="text" name="job" value="<?php echo $_SESSION['user_data']['job'] ?>"  > <i>Job</i> 

   </div>

   <div class="inputBox"> 

<input type="text" name="skill" value="<?php echo $_SESSION['user_data']['skill'] ?>"  > <i>Skill</i> 

</div>


   <div class="links"> <a href="member.php"></a> <a href="member.php">Profile</a> 

   </div> 

   <div class="inputBox"> 

    <input type="submit" name="update" value="Update"> 

   </div>

   <div class="inputBox"> 

 <?php   include('include/alerts.php') ?>

  </div>

 </form>

 <form action="edits.php" class="form" method="post" enctype="multipart/form-data">




 <div class="inputBox flex"> 

 <label for="Profile Pic" class="profileimg">Profile Pic</label>


       <input type="file" name="img" accept=".jpg, .jpeg, .png" />

      </div>
      <div class="inputBox"> 

<input type="submit" name="changeimg" value="Change Image"> 

</div>



 </form>

 </div> 

</div> 

</section> <!-- partial --> 

</body>
</html>