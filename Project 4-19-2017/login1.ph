
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
		
	</style>



</head>
<body>
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


	
</body>
</html>



<?php 
session_start();
	// Get values passed form form in login.php file 
	$username = $_POST['user'];
	$password = $_POST['password'];
	
	
	// to prevent mysql_injection 
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	
	//connect to the server and select database 
	mysql_connect("localhost", "root", "");
	mysql_select_db("Gradebook");
	
	
	
	
	
	if(empty($username) or empty($password)){
			echo "You left a field empty. <br>
			click here to <a href='login.php'>try again</a>";
			
		
		}else {
		// Query the database for users

		$result = mysql_query("select * from users where username = '$username' and password ='$password'")
		or die("Failed to query databse ".mysql_error());
	
		$row = mysql_fetch_array($result);
		
		if ($row['username'] == $username && $row['password'] == $password ){
			echo "Login success!!! Welcome ".$row['username'];
			$_SESSION['username'] = $username;
			
			if( isset($_POST['remember']) ) {	
		
				setcookie('username', $username, time()+60*60*7);
				
				if($Role['teacher'] == $Role) {
					header("location: indexT.php"); 
		
				}else {
					header("location: indexS.php"); 
					}

			}else{
				if($Role['teacher'] == $Role) {
					header("location: indexT.php"); 
		
				}else {
					header("location: indexS.php"); 
					}
				}
			
		}else {
			header("location: login.php");
			}
		
		}
		
		
		
		
		
		
		
// 			if ($row['username'] == $username && $row['password'] == $password ){
// 		echo "Login success!!! Welcome ".$row['username'];
// 		
// 		
// 			
// 	elseif ($username == "") {
// 			echo "Please enter in a valid login";
// 			}
// 			
// 	elseif ($password == "")	{	
// 		echo "Please enter in a valid login!";
// 	
// 	} else {
// 		echo "Failed to login!";
// 	}
// 	
// 	
// 	
	
	
?>