<?php
// Include the database file to establish a database connection
include('config/database.php');

// Include custom functions, such as 'access_deny();'
include('include/functions.php');

access_deny();
