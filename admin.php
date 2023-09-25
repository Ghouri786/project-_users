<?php
// Include the database file to establish a database connection
include('config/database.php');

// Include custom functions, such as 'access_deny();'
include('include/functions.php');

// Check and deny access for users who are not logged in
access_deny();

// Check and deny access for non-admin users
admin_access();

// Handle user deletion when the 'Delete User' button is pressed
if(isset($_POST['deluser'])){
    extract($_POST);
    // Check if the user's role is 'admin' and prevent deletion
    if($role==='admin'){
        $_SESSION['error'] = "Admin User cannot be Deleted";
    }else{
        // Construct an SQL query to delete the user with the specified ID
        $del = "delete from userstb where id=" . $id;
        // Execute the SQL query
        $delquery = $sql_connection->query($del);
    }
}

// Handle role assignment when the 'Assign Role' button is pressed
if(isset($_POST['roleselect'])){
    if(isset($_POST['role'])){
        extract($_POST);
        // Check if a role has been selected
        if($roleselect){
            // Construct an SQL query to update the user's role in the database
            $update = "UPDATE userstb SET user_role = '" . $roleselect . "' WHERE id = '" . $id . "'";
            // Execute the SQL query
            $update_query = $sql_connection->query($update);
            // Set a success message
            $_SESSION['success'] = "User " .$username . " Assign " .ucwords($roleselect). " Role Succesfully";
        }else{
            // Set an error message if no role is selected
            $_SESSION['error'] = "Please Select a valid User Role";
        }
    }
}
?>


<!-- *************HTML******************** -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="cen">
        <div class="nav-admin">
            <h2 class="userh">User Management</h2>
            <div class="icons">
                <a href="member.php"><i class="color fa-solid fa-user fa-xl"></i></a>
                <a href="logout.php">
                    <i class="color fa fa-sign-out-alt fa-xl"></i>
                </a>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>User-Role</th>
                <th>Job</th>
                <th>Assign Role</th>
                <th></th>
            </tr>
        </thead>
  
        <tbody>
        
        <?php 
        $select = "select * from userstb";
        $sql = $sql_connection->query($select);

        if ($sql->num_rows > 0) :

            while ($result = mysqli_fetch_assoc($sql)) :
        ?>
        

            <tr>
                <td><?php echo $result['id']; ?></td>
                <td><?php echo $result['name']; ?></td>
                <td><?php echo $result['email']; ?></td>
                <td><?php echo ucwords($result['user_role']) ; ?></td>
                <td><?php echo $result['job']; ?></td>
                <td>
                    <form action="admin.php" method="post"> 
                        <input type="hidden" name="id" value="<?php echo $result['id']  ?>" />
                        <input type="hidden" name="username" value="<?php echo $result['name']  ?>" />
                        <input type="hidden" name="role" value="<?php echo $result['user_role']  ?>" />
                        <select id="roleSelect" name="roleselect">
                            <option disabled selected>Choose a User Role</option>
                            <option value="admin" name="admin" >Admin</option>
                            <option value="member" name="member">Member</option>
                            <option value="general" name="general">General</option>
                        </select>
                </td>
                <td>
                    <button class="assignRoleBtn" name="role" >Assign Role</button>
                    <button class="deleteuserBtn" name="deluser" >Delete User</button>
                    </form>
                </td>
            </tr>

<?php 
            endwhile;
        endif;
?>
        </tbody>
    </table>

    <div>
    <?php   include("include/alerts.php") ?>
    </div>

    <script src="admin.js"></script>
</body>
</html>
