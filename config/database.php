<?php

// Define database connection information
$servername= 'localhost';
$username= 'root';
$pass ='';
$dbname = 'usersdb';

// Create a new MySQLi connection to the database
$sql_connection= new mysqli($servername,$username,$pass);

// Check if there was an error in the database connection
if($sql_connection->error){
    die( "Connection Failed with Database" . $sql_connection->error);
}

// Create the database if it doesn't already exist
$db = "Create Database If not exists $dbname";
$db_query= $sql_connection->query($db);

// Select the newly created or existing database
$sql_connection->select_db($dbname);

// Create a table in the database for storing user data if it doesn't already exist
$dbtable = "Create table if not exists userstb (
    id int auto_increment primary key,
    name varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    address varchar(500),
    hobbies varchar(255),
    job varchar(255),
    skill varchar(255),
    img varchar(255),
    gender varchar(11),
    user_role enum ('general' , 'admin' , 'member') Default 'general'

)";

$dbtable_query = $sql_connection->query($dbtable);

$dbtable2 = "Create table if not exists reset_pass (
    id int auto_increment primary key,
    user_id int (11),
    OTP varchar(255) NOT NULL

)";

$dbtable_query = $sql_connection->query($dbtable2);

?>