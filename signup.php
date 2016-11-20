<?php

include('config.php');

// table name 
$tbl_name="temp_members_db";

// Random confirmation code 
$confirm_code=md5(uniqid(rand())); 

// values sent from form 
$name =$_POST['fname'].$_POST['lname'];
$email=$_POST['email'];
$password = $_POST['password'];
$country = "USA";

// Insert data into database 
$sql="INSERT INTO $tbl_name(confirm_code, name, email, password, country)VALUES('$confirm_code', '$name', '$email', '$password', '$country')";
$result=mysql_query($sql);

// if suceesfully inserted data into database, send confirmation link to email 
if($result){
// ---------------- SEND MAIL FORM ----------------

// send e-mail to ...
$to=$email;

// Your subject
$subject="Your confirmation link here";

// From
$header="from: your name <your email>";

// Your message
$message="Your Comfirmation link \r\n";
$message.="Click on this link to activate your account \r\n";
$message.="http://www.crediblesystem.com/hackathon2016/confirmation.php?passkey=$confirm_code";

// send email
$sentmail = mail($to,$subject,$message,$header);
}

// if not found 
else {
echo "<p>Not found your email in our database</p><br/>";
}
$prompt = "Your Confirmation link Has Been Sent To Your Email Address.";
// if your email succesfully sent
if($sentmail){
echo "<script type='text/javascript'>alert('$prompt');</script>";
}
else {
echo "<p>Cannot send Confirmation link to your e-mail address</p>";
}
?>