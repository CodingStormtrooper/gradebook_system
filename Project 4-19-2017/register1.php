<?php
	session_start();
	
	
	//connect to database 
	 $db = mysqli_connect("localhost", "root", "", "Gradebook");

	

	
	if (isset($_POST['register_btn'])) {
		$username = mysql_real_escape_string($_POST['username']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = rand(1000,5000);
	
		
		$role = ($_POST['role']);
	
		

		$hash = md5( rand(0,1000) );
		
		if ($role == "Teacher"){
			$role == "Teacher";
		}
		elseif ($role == "Student"){
			$role == "Student";
		}
		
	
		$sql="SELECT * FROM users WHERE username='$username'";
		$result =mysqli_query($db, $sql);

		// Mysql_num_row is counting table row
		$count=mysqli_num_rows($result);
		
		// If result matched $username and $password, table row must be 1 row
		if($count>0){
    		echo "Username already exists";
    	
    	}
		else{
    
    		if ($username == "") {
			echo "Please enter in a valid username";
			}
		
			elseif ($email == "") {		
				echo "Please enter in a valid email!";
			}
			
			//chck if passwords are not empty and matching 	
				elseif ($password != "") {
			
					//create user 
					//$password = md5($password); // hass password before storing for security purposes 
					//$result = mysql_query("INSER INTO users(username, email, password) VALUES('$username', '$email', '$password')"
					//		or die("Failed to query databse ".mysql_error());
				
					$sql1 = "INSERT INTO register (username, password, email, hash, role) VALUES ('$username', '$password', '$email', '$hash', '$role')";	
					mysqli_query($db, $sql1);
					$_SESSION['message'] = "You are now logged in";
					$_SESSION['username'] = $username;
				
					$to = $email; // Send email to our user
					$subject = 'Signup | Verification'; // Give the email a subject 
					$message = '
 
						Thanks for signing up!
						Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
						------------------------
						Username: '.$username.'
						Password: '.$password.'
						------------------------
 
						Please click this link to activate your account:
						http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
 
						'; // Our message above including the link
                     
						$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
						$mail = mail($to, $subject, $message, $headers); // Send our email

					}

		
		// check username is empty
			else{  
				// failed 
				echo "The two passwords do not match";
				
			}
		}
	}
		
		
	
	

?>


<html>
<head>
	<title>Registration</title>
		<style>
		table {
			align: center;
		}
		
		

#login{
	float: right;	
}

	</style>

<!-- 	
	<link rel="stylesheet" type="text/css"
 -->
</head>
<body>
	<div id="login">
		<a href="login.php">Login</a>
	</div>
	
	
	<div class="header">
		<h1 style="font-family: Tahoma;">Register</h1>
		
	
	</div>

	<form method="post" action="register.php">
		
	<div>
		<table>
			<tr> 
				<td>Username:</td>	
<!-- 
				//<td><input type="text" name="username" class="textInput"></td>
 -->
 
				<td><input id="username" name="username" type="text"></td>
        		
			
			</tr>
			<tr> 
				<td>Email:</td>	
				<td><input type="email" name="email" class="textInput"></td>
			</tr>		

			
			<tr>
				<td>Status: </td>
					<td><input type="radio" name='role' value="Teacher"> Teacher
					<input type="radio" name='role' value="Student"> Student </td>
					
			</tr>
			<tr> 
				<td><input type="submit" name="register_btn" class="Register"></td>
			</tr>

		</table>
	</div>
	</form>
	</form>
</body>
</html>