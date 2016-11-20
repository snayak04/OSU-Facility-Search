<?php
session_start();
if(!isset($_SESSION['user_id'])){
    die("Please login");
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style2.css">
</head>

<body>



<div id="facilities_form">
	<div>
		<h1>Details of facility</h1> 
		<h4>Please fill out the required details</h4> 
	</div>
		<p id="failure">Oops...form not submitted</p>  
		<p id="success">Your facility was added successfully. Thank you!</p>

		   <form method="post" action="facility.php">
			<div>
		      <label for="name_facility">
		      	<span class="required">What services or facilities did you find? *</span> 
		      	<input type="text" id="name_facility" name="name_facility" value="" placeholder="Ovens, Computers etc." required="required"/>
		      </label> 
			</div>
		       <div>		          
		      <label for="building_name">
		      <span class ="required">Where did you find it? * </span>
			  <select id="building_name" name="building_name"> 
			  <?php
mysql_connect("localhost","saiinfot_hohio","hackathon2016");
mysql_select_db("saiinfot_registered_members");
//query
$sql=mysql_query("SELECT building_name FROM buildings");
if(mysql_num_rows($sql)){
while($rs=mysql_fetch_array($sql)){
      $select.='<option value="'.$rs['building_name'].'">'.$rs['building_name'].'</option>';
  }
}
echo $select;
?>
			      </select>
		      </label>
			</div>
			<div>
		      <label for="building_exactplace">
		      	<span class="required">Any specific location within the building? *</span>
		      	<input type="building_exactplace" id="building_exactplace" name="building_exactplace" value="" placeholder="Room no., what floor" required="required" />
		      </label>  
			</div>
			
			<div>		          
		      <label for="other_info">
		       <span>Addition Details:</span>
		      	<textarea id="other_info" name="other_info" placeholder=""></textarea> 
		      </label>  
			</div>
			<div>		           
		      <button name="submit" type="submit" id="submit" >Submit</button> 
			</div>
		   </form>

	</div>
</body>
</html>