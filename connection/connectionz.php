
<?php

$db_username = 'root'; // Your MYSQL Username.
$db_password = ''; // Your MYSQL Password.
$db_name = 'finaldb'; // Your Database name.
$db_host = 'localhost';


//here we are establishing a connection to the MySQL database
$conDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)or
die('Error: Could not connect to database.');

?>
