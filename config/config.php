<?php

if($_SERVER['HTTP_HOST']== 'localhost'){
define("DIR", $_SERVER['DOCUMENT_ROOT'] . '/project_users/');
define("base_url", 'http://localhost/project%20_users' );
}else{
define("dir", __DIR__ );
define("base_url", 'http://' );
}
?>