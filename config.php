<?php

$host="localhost"; // Host name 
$username="saiinfot_hohio"; // Mysql username 
$password="hackathon2016"; // Mysql password 
$db_name="saiinfot_registered_members"; // Database name 


//Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect to server"); 
mysql_select_db("$db_name")or die("cannot select DB");

?>