<?php 
// Include the database file to establish a database connection
include('config/database.php');
include('config/config.php');
// Include custom functions, such as 'access_deny()'
include('include/models/functions.php');

// Check and prevent access to this page for logged-in users
prevent_access();

deleteexpiredotp($sql_connection);

$randomotp = rand(101010, 999999);

if(isset($_POST['reset'])){

extract($_POST);
$sql = "select * from userstb where email = '$email'";
$query1 = $sql_connection->query($sql);
if($query1->num_rows>0){
$result =mysqli_fetch_assoc($query1);
$user_id =$result['id'];
$message = "Your OTP for Reset Password is " . $randomotp;
$to = $email;
$subject = "Password Reset";
$mail = mail($to,$subject,$message);

if($mail){
     $sql1 = "select * from reset_pass where user_id= $user_id";
     $querysql1 = $sql_connection->query($sql1);
     if($querysql1->num_rows>0){
      $_SESSION['error'] = "Already sent OTP Now wait 2 minutes";
     }
     else{
     $sql = "insert into reset_pass (user_id, OTP) values ($user_id , '$randomotp')";
     $query = $sql_connection->query($sql);
     $sql1 = "select * from reset_pass where user_id= $user_id";
     $querysql1 = $sql_connection->query($sql1);
     $result2 = mysqli_fetch_assoc($querysql1);
     $createotp = $result2['created_at'];
     $expired_at = strtotime('+2 minutes', strtotime($createotp));
     $formatted_expired_at = date('Y-m-d H:i:s', $expired_at);
     $id =$result2['id'];
     $sql2 = "update reset_pass set expired_at = '$formatted_expired_at' where id= $id";
     $querysql2 = $sql_connection->query($sql2);
    $_SESSION['success'] = "OTP sent to Email Succesfully";
    header("location:reset.php");
    exit;
     }
}

    
}else{
    $_SESSION['error'] = "Email not Registered";
}

}




?>

<?php   include("include/templates/header.php") ?>
 
 <!-- partial:index.partial.html --> 

  <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 

   <div class="signin"> 

    <div class="content"> 

     <h2>Sign In</h2> 

    <form action="forget_password.php" class="form" method="post">

    <div class="inputBox"> 

<input type="Email" name="email" > <i class="required">Email</i> 

</div>

      <div class="links"> 
        <a href="#"></a> 
        <a href="index.php">Sign in</a> 
      </div> 

      <div class="inputBox"> 

       <input type="submit" name="reset" value="Next"> 

      </div>
      
      <div class="inputBox"> 

    <?php   include("include/models/alerts.php") ?>

      </div>

    </form>

    </div> 

   </div> 

  </section> <!-- partial --> 

  <?php   include("include/templates/footer.php") ?>