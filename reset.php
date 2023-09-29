<?php 


// Include the database file to establish a database connection
include('config/database.php');

// Include custom functions, such as 'prevent_access()'
include('include/functions.php');

// Check and prevent access to this page for logged-in users
prevent_access();

if(isset($_POST['reset_pass'])){

    extract($_POST);

    $sql1 = "select * from reset_pass where OTP = $otp";
    $query2 =$sql_connection->query($sql1);
if($query2->num_rows>0){

$result = mysqli_fetch_assoc($query2);
$user_id =$result['user_id'];

if($new_pass === $confirm_pass){

    $hashed = password_hash($new_pass , PASSWORD_DEFAULT);
    $sql2 = "update userstb set password = '$hashed' where id = $user_id";
    $query1 =$sql_connection->query($sql2);
    if($query1){
        $sql3 = "delete from reset_pass where user_id= $user_id";
        $query3 =$sql_connection->query($sql3);
        $_SESSION['success'] = "Password Reset Successfully";
        header("location: index.php");
        exit;
    }

}else{
    $_SESSION['error'] = "Confirm Password not Match";
}


}else{
    $_SESSION['error'] = "OTP not Valid";
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

    <form action="reset.php" class="form" method="post" >

        <div class="inputBox"> 
  
         <input type="text" name="otp" > <i class="required">OTP</i> 
  
        </div>
       
 
      <div class="inputBox"> 

       <input type="password" name="new_pass" > <i class="required">New Password</i> 

      </div> 

      <div class="inputBox"> 

       <input type="password" name="confirm_pass" > <i class="required">Confirm Password</i> 

      </div> 


      <div class="links" > <a href="#"></a> <a href="index.php">Login</a> 

      </div> 

      <div class="inputBox"> 

       <input type="submit" name="reset_pass" value="Reset Password"> 

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