<?php

include('config.php');

// Passkey that got from link 
$passkey=$_GET['passkey'];
$tbl_name1="temp_members_db";

// Retrieve data from table where row that match this passkey 
$sql1="SELECT * FROM $tbl_name1 WHERE confirm_code ='$passkey'";
$result1=mysql_query($sql1);

// If successfully queried 
if($result1){

// Count how many row has this passkey
$count=mysql_num_rows($result1);

// if found this passkey in our database, retrieve data from table "saiinfot_temp_members_db"
if($count==1){

$rows=mysql_fetch_array($result1);
$name=$rows['fname' + 'lname'];
$email=$rows['email'];
$password=$rows['password']; 
$country="USA";
$tbl_name2="registered_members";

// Insert data that retrieves from "saiinfot_temp_members_db" into table "registered_members" 
$sql2="INSERT INTO $tbl_name2(name, email, password, country)VALUES('$name', '$email', '$password', '$country')";
$result2=mysql_query($sql2);
}

// if not found passkey, display message "Wrong Confirmation code" 
else {
echo "Wrong Confirmation code";
}

// if successfully moved data from table"saiinfot_temp_members_db" to table "registered_members" displays message "Your account has been activated" and don't forget to delete confirmation code from table "saiinfot_temp_members_db"
if($result2){

echo "<meta http-equiv=\"Refresh\" content=\"5; url=\"http://www.crediblesystem.com/hackathon2016/registration.html\"><br/>Your account has been activated";

// Delete information of this user from table "saiinfot_temp_members_db" that has this passkey 
$sql3="DELETE FROM $tbl_name1 WHERE confirm_code = '$passkey'";
$result3=mysql_query($sql3);

}

}
?>