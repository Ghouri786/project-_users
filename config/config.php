<?php

// Start a new session for managing user sessions
session_start();

date_default_timezone_set("Asia/Karachi");

$current_page="";
if($_SERVER['HTTP_HOST']== 'localhost'){
define("DIR", $_SERVER['DOCUMENT_ROOT'] . '/project_users/');
define("base_url", 'http://localhost/project%20_users' );
}else{
define("dir", $_SERVER['DOCUMENT_ROOT']);
define("base_url", 'http://' );
}





?>