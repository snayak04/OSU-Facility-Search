<?php

/*** begin the session ***/
session_start();

if(!isset($_SESSION['user_id']))
{
    $message = '<a class = "login" href="registration.php">Register </a>   <a class ="login" href="login.php"> Login</a>';
}
else
{
    try
    {
        /*** connect to database ***/
        /*** mysql hostname ***/
        $mysql_hostname = 'localhost';

        /*** mysql username ***/
         $mysql_username = 'saiinfot_hohio';

    /*** mysql password ***/
    $mysql_password = 'hackathon2016';

    /*** database name ***/
    $mysql_dbname = 'saiinfot_registered_members';


        /*** select the users name from the database ***/
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("SELECT phpro_username FROM phpro_users 
        WHERE phpro_user_id = :phpro_user_id");

        /*** bind the parameters ***/
        $stmt->bindParam(':phpro_user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $phpro_username = $stmt->fetchColumn();

        /*** if we have no something is wrong ***/
        if($phpro_username == false)
        {
            $message = '<a class ="login" href="registration.php">Register </a>  <a class ="login" href="login.php"> Login</a>';
        }
        else
        {
            $message = '<div class = "alogin">Welcome, '.$phpro_username.' <a href="logout.php"> Log Out </a></div>' ;
        }
    }
    catch (Exception $e)
    {
        /*** if we are here, something is wrong in the database ***/
        $message = '<a class ="login" href="registration.php">Register </a>  <a class ="login" href="login.php"> Login</a>';
    }
}

?>
<!DOCTYPE html>
<html >

	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" type="image/x-icon" href="https://production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
		<link rel="mask-icon" type="" href="https://production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
		<title>OSU - Facility Search</title>
		<link rel="stylesheet" href="css/style1.css">
	</head>

	<body translate="no" >

<?php echo $message; ?>
<br/>
<img class ="main" src="images/OSU.jpg"/>

	<form class="form-wrapper" action="./search.php" id="searchForm" method="get">
		<input type="text" id="search" placeholder="Search for a facility" name="q" />
		<input type="submit" value="Go" id="submit">
	</form>
	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


	</body>
</html>
 
