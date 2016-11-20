<?php

$mysql_hostname = 'localhost';

        /*** mysql username ***/
    $mysql_username = 'saiinfot_hohio';

    /*** mysql password ***/
    $mysql_password = 'hackathon2016';

    /*** database name ***/
    $mysql_dbname = 'saiinfot_registered_members';
try {
    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    // set the PDO error mode to exception	
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $name_facility=$_POST['name_facility'];
$building_name=$_POST['building_name'];
$building_exactplace=$_POST['building_exactplace'];
$other_info=$_POST['other_info'];
session_start();
$user_name = $_SESSION['user_id'];
$sql = "INSERT INTO facility (name_facility, building_name, building_exactplace, other_info, user_name) VALUES ('$name_facility', '$building_name', '$building_exactplace', '$other_info', '$user_name')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo 'Thanks for the input!"<meta http-equiv="Refresh" content="1;url=http://www.crediblesystem.com/hackathon2016">';
    }
catch(PDOException $e)
    {
     echo('Server error. Try again later!<meta http-equiv="Refresh" content="1;url=http://www.crediblesystem.com/hackathon2016">');
    }

$conn = null;
?>
