<?php 
// Include the database file to establish a database connection
include('config/database.php');
include('config/config.php');
// Include custom functions, such as 'access_deny()'
include('include/models/functions.php');


// Check and prevent access to this page for logged-in users
access_deny();
?>

<?php   
$current_page = 'member';
include("include/templates/header.php") ?>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1>Profile</h1>
        </div>

        <!-- Navbar icons and links -->
        <ul>
            <li>
                <a href="#message">
                    <span class="icon-count">29</span>
                    <i class="fa fa-envelope fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="#notification">
                    <span class="icon-count">59</span>
                    <i class="fa fa-bell fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
        <!-- End of Navbar -->
    </div>
    <!-- End of Navbar top -->

    <!-- Sidenav (Side Navigation) -->
    <div class="sidenav">
        <!-- User profile information -->
        <div class="profile">
        <?php if($_SESSION['user_data']['img']) : ?><img src="<?php echo $_SESSION['user_data']['img']; ?>" alt="" width="200" height="200"> <?php endif; ?>
            <div class="name">
                <?php if($_SESSION['user_data']['name']) : echo ucwords($_SESSION['user_data']['name']); endif; ?>
            </div>
            <div class="job">
                <?php if($_SESSION['user_data']['job']) : echo ucwords($_SESSION['user_data']['job']); endif; ?>
            </div>
        </div>

        <!-- Side navigation links -->
        <div class="sidenav-url">
            <div class="url">
                <a href="#profile" class="active">Profile</a>
                <hr align="center">
            </div>
            <div class="url admin">
                <a href="admin.php">Admin Dashboard</a>
                <hr align="center">
            </div>
        </div>
    </div>
    <!-- End of Sidenav -->

    <!-- Main Content -->
    <div class="main">
        <!-- Display messages/alerts here -->
        <h2 class="msg"><?php   include("include/models/alerts.php") ?></h2>

        <!-- Identity Section -->
        <h2>IDENTITY</h2>
        <div class="card">
            <div class="card-body">
               <a href="edits.php"> <i class="fa fa-edit fa-xs edit"></i> </a>
                <table>
                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user_data']['id'] ?></td>
                        </tr>
                        <tr>
                            <td>User-Role</td>
                            <td>:</td>
                            <td Id="user_role"><?php echo $_SESSION['user_data']['user_role'] ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user_data']['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user_data']['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user_data']['gender'] ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user_data']['address'] ?></td>
                        </tr>
                        <tr>
                            <td>Hobbies</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user_data']['hobbies'] ?></td>
                        </tr>
                        <tr>
                            <td>Job</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user_data']['job'] ?></td>
                        </tr>
                        <tr>
                            <td>Skill</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user_data']['skill'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Social Media Section -->
        <h2>SOCIAL MEDIA</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <div class="social-media">
                    <!-- Icons for various social media platforms -->
                    <!-- You may add links to these social media profiles if needed -->
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                    </span>
                    <!-- Add more social media icons here if necessary -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

    <!-- JavaScript file -->
    <?php   include("include/templates/footer.php") ?>
