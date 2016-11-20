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
		<style>
input[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('http://findicons.com/files/icons/1389/g5_system/32/toolbar_find.png');
    background-position: 10px 10px;
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
	margin-top:20px;
	margin-left:10px;
}

input[type=text]:focus {
    width: 75%;
}
</style>
	</head>
<div id="header">
<div id="searchAlign">
	<body translate="no" >
<?php echo $message; ?>


<a href="index.php"><img class ="inner" src="images/OSUthumb.png"></a>
	<form action="./search.php" id="searchForms" method="get" >
		<input type="text" id="search" name="q" size="50" value="<?php echo $_GET['q']; ?>">
	</form>

	</div>
	<br />
	
	<?php
	$q = $_GET['q'];
	$terms= explode(" ", $q);
	$query= "SELECT * FROM facility WHERE ";
	$query2 = "SELECT * FROM facility WHERE ";
	$i=0;
	foreach ($terms as $each) {
		$i++;
		if($i==1){
			$query.="name_facility LIKE '%".$each."%' ";
			$query2.="building_name LIKE '%".$each."%' ";
		}
		else{
			$query.="OR name_facility LIKE '%".$each."%' ";
			$query2.="OR building_name LIKE '%".$each."%' ";
		}
	}
	// Connect to DB
	mysql_connect("localhost", "saiinfot_hohio", "hackathon2016");
	mysql_select_db("saiinfot_registered_members");
	$query = mysql_query($query);
	$query2 = mysql_query($query2);
	$numrows = mysql_num_rows($query);
	$numrows2 = mysql_num_rows($query2);
	if($numrows > 0 || $numrows2 > 0){
		if($numrows>0){
		while($row = mysql_fetch_assoc($query)){
			$facility = $row['name_facility'];
			$building = $row['building_name'];
			$location = $row['building_exactplace'];
			$info = $row['other_info'];	
			echo "<h3>" .$facility. " <a target=\"_blank\" href= \"http://maps.google.com/?q=".$building.", Ohio\">".$building."</a> <br/>".$location. "<br/>" .$info. "<br/> </h3><br/>";
		}
		echo "Do you know of more places where this service/ facility is provided? <a href=\"add_facilities.php\">click here to add</a><br/>";}
		else{
			while($row2 = mysql_fetch_assoc($query2)){
			$facility1 = $row2['name_facility'];
			$building1 = $row2['building_name'];
			$location1 = $row2['building_exactplace'];
			$info1 = $row2['other_info'];	
			echo "<h3>" .$facility1. " <a target=\"_blank\" href = \"http://maps.google.com/?q=".$building1.", Ohio\">".$building1."</a> <br/>" .$location1. "<br/>" .$info1. "<br/> </h3><br/>";
		}
		echo "Do you know of more services/ facilities that are provided in this building? <a href=\"add_facilities.php\">click here to add</a><br/>";
		}
		
	}
	else{
		echo "<h4 class=\"footer\">No results found for ".$q.". Would you like to add some details? <a href=\"add_facilities.php\">click here</a></h4><br/>";
	}
	//disconnet
	mysql_close();
	?>
	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	</div>

	</body>
</html>
 
