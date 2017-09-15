
<?php
	session_start();
	
	
?>
<html>
<head>
	<title>Login</title>

	<style>
	
		body {
			text-align: center;
		}
		
		
		#blackbb{
		
			background-color: #grey;
		
		}
		#container{
			background-color: #CSC1C0;
		
		}
		
		#logincard {
			background-color: #white;
		
		}
		
		
	</style>



</head>

<body>


<div id="blackbb">
<div id="container">
<form action="process.php" method="POST">

<br>
  <div class="login-card">
    <h1>Log-in</h1><br>
  <form>
    <input type="text" name="user" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="login" class="login login-submit" value="login">
  </form>

  <div class="login-help">
    <a href="register.php">Register</a> • <a href="forgot_login.php">Forgot Password</a>
  	<br>
	<input type="checkbox" id="remember" value="1"/>Remember Me

  </div>
</div>

<!-- 

		<input type="text" id="user" name="user" />
		<input type="password" id="password" name="password"  />
		<input  type="submit" id="btn" value="Login" />
 -->


</div> <!-- div end container --!>
</div>
</body>

</html>