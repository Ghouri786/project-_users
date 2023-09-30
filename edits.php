<?php 
// Include the database file to establish a database connection
include('config/database.php');
include('config/config.php');
// Include custom functions, such as 'access_deny()'
include('include/models/functions.php');



// Check if access is denied for the current user
access_deny();


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
        $update = "UPDATE userstb SET name ='$username', email='$email', address='$address', hobbies='$hobbies', job='$job', skill='$skill', gender='$gender'";
// ****************
        $imgget = $_FILES['img'];
        if($imgget['size']>0){
             // Construct a SQL query to retrieve user data by their ID
            $select = "SELECT * FROM userstb WHERE id=" . $_SESSION['user_data']['id'];

           // Execute the select query
           $select_query = $sql_connection->query($select);

           // Fetch the user's current data
           $select_result = mysqli_fetch_assoc($select_query);
           if (empty($select_result['img'])){
            $imgpath = $select_result['name']. "_" . $imgget['name'];
            $uploadDirectory = 'include/assests/images/uploads/';
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
            $uploadDirectory = 'include/assests/images/uploads/';
            if (!file_exists($uploadDirectory)){
                mkdir($uploadDirectory, 0755, true);
            }
            $imgpathsave = $uploadDirectory . $imgpath;
            $uploaded = move_uploaded_file($imgget['tmp_name'], $imgpathsave);
                    
        }

        $update .= ", img='$imgpathsave'";
    }
// ******************

$update .= " WHERE id=" . $_SESSION['user_data']['id'];
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





// **************Change Password Functionality

if(isset($_POST['chg_pass'])){

extract($_POST);

$oldpassword = $_SESSION['user_data']['password'];

$user_id =$_SESSION['user_data']['id'];

$verifypass = password_verify($oldpass , $oldpassword);

if($verifypass){

    if($newpass===$conpass){

        $hashed = password_hash($newpass , PASSWORD_DEFAULT);
        $sql2 = "update userstb set password = '$hashed' where id = $user_id";
        $query1 =$sql_connection->query($sql2);
        $_SESSION['user_data']['password'] = $hashed;
        $_SESSION['success'] = "Password Change Successfully";
        header("location: member.php");
        exit;

    }else{
        $_SESSION['error'] = "Confirm Password Not Match";
    }
}else{
    $_SESSION['error'] = "Wrong Old Password";
}

}



?>


<?php   

$current_page = 'edit';

include("include/templates/header.php") ?>



<div><?php   include("include/models/alerts.php") ?></div>
    <div class="body">
  <div class="container"> 
    <div class="title">Edit Profile</div>
    
    <div class="content">
    <form action="edits.php" class="form" method="post" enctype="multipart/form-data">
        
        <div class="user-details">
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" value="<?php echo $_SESSION['user_data']['name'] ?>"  >
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="Email" name="email" value="<?php echo $_SESSION['user_data']['email'] ?>" >
          </div>
          <div class="input-box" style="width:100%">
            <span class="details">Address</span>
            <input type="text" name="address" value="<?php echo $_SESSION['user_data']['address'] ?>"  > 
          </div>
          <div class="input-box">
            <span class="details">Hobbies</span>
            <input type="text" name="hobbies" value="<?php echo $_SESSION['user_data']['hobbies'] ?>"  >  
          </div>
          <div class="input-box">
            <span class="details">Skill</span>
            <input type="text" name="skill" value="<?php echo $_SESSION['user_data']['skill'] ?>"  >
          </div>
          <div class="input-box">
            <span class="details">Job</span>
            <input type="text" name="job" value="<?php echo $_SESSION['user_data']['job'] ?>"  > 
          </div>
          <div class="input-box">
            <span class="details">Profile Pic</span>
            <input type="file" name="img" accept=".jpg, .jpeg, .png" />
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" value="Male" id="dot-1" <?php if($_SESSION['user_data']['gender'] === "Male") echo "checked"; ?> >
          <input type="radio" name="gender" value="Female" id="dot-2" <?php if($_SESSION['user_data']['gender'] === "Female") echo "checked"; ?>>
          <input type="radio" name="gender" value="Prefer not to say" id="dot-3" <?php if($_SESSION['user_data']['gender'] === "Prefer not to say") echo "checked"; ?>>
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
        <input type="submit" name="update" value="Update"> 
        </div>
        
      </form>
    </div>
  </div>






<!-- Change Password Section Start -->



  <div class="container">
    <div class="title">Change Password</div>
    <div class="content">
    <form action="edits.php" class="form" method="post">
      <div class="user-details">
      <div class="input-box" style="width:100%; margin-bottom:35px">
            <span class="details">Old Password</span>
            <input type="text" name="oldpass" placeholder="Enter your password" required>
          </div>
          <div class="input-box" style="width:100%; margin-bottom:35px">
            <span class="details">New Password</span>
            <input type="text" name="newpass" placeholder="Confirm your password" required>
          </div>
          <div class="input-box" style="width:100%; margin-bottom:35px">
            <span class="details">Confirm Password</span>
            <input type="text" name="conpass" placeholder="Confirm your password" required>
          </div>
    </div>
        <div class="button">
        <input type="submit" name="chg_pass" value="Update"> 
        </div>
      </form>
    </div>
  </div>
<!-- Change Password Section End -->
</div>

<?php   include("include/templates/footer.php") ?>