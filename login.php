<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form" >
 <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
      </ul> 
	  <div class="tab-content">
          <h1>Welcome Back!</h1>
          
          <form action="login_submit.php" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" id="phpro_username" name="phpro_username"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" id="phpro_password" name="phpro_password" />
          </div>
          
          <!--<p class="forgot"><a href="#">Forgot Password?</a></p>-->
		
          <button class="button button-block" value="→ Login" />Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>