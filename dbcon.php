



<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'londoners');
define('DB_PASSWORD', 'London123!');
define('DB_NAME', 'Londoners');
 
/* connect to database*/
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
