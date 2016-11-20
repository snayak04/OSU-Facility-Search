<?php
/*** begin our session ***/
session_start();

/*** first check that both the username, phpro_password and form token have been sent 
if(!isset( $_POST['phpro_username'], $_POST['phpro_password'], $_POST['form_token']))
{
    $message = 'Please enter a valid username and phpro_password';
}***/
/*** check the form token is valid ***/
if( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}
/*** check the username is the correct length ***/
elseif (strlen($_POST['phpro_username']) < 4)
{
    $message = 'Incorrect Length for Username';
}
/*** check the phpro_password is the correct length ***/
elseif (strlen($_POST['phpro_password']) < 4)
{
    $message = 'Incorrect Length for phpro_password';
}
/*** check the username has only alpha numeric characters 
elseif (ctype_alnum($_POST['phpro_username']) != true)
{
    /*** if there is no match 
    $message = "Username must be alpha numeric";
}**/
/*** check the phpro_password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['phpro_password']) != true)
{
        /*** if there is no match ***/
        $message = "phpro_password must be alpha numeric";
}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $phpro_username = filter_var($_POST['phpro_username'], FILTER_SANITIZE_STRING);
    $phpro_password = filter_var($_POST['phpro_password'], FILTER_SANITIZE_STRING);

    /*** now we can encrypt the phpro_password ***/
    $phpro_password = sha1( $phpro_password );
    
    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'saiinfot_hohio';

    /*** mysql phpro_password ***/
    $mysql_phpro_password = 'hackathon2016';

    /*** database name ***/
    $mysql_dbname = 'saiinfot_registered_members';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_phpro_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("INSERT INTO phpro_users (phpro_username, phpro_password ) VALUES (:phpro_username, :phpro_password )");

        /*** bind the parameters ***/
        $stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
        $stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR, 40);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        unset( $_SESSION['form_token'] );

        /*** if all is done, say thanks ***/
        $message = '<meta http-equiv="Refresh" content="2; url="http://www.crediblesystem.com/hackathon2016/login.php">New user added';
    }
    catch(Exception $e)
    {
        /*** check if the username already exists ***/
        if( $e->getCode() == 23000)
        {
            $message = 'Username already exists';
        }
        else
        {
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later"';
        }
    }
}
?>

<html>
<head>
<title>PHPRO Login</title>
</head>
<body>
<p><?php echo $message; ?>
</body>
</html>
