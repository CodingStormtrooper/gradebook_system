<?php 
session_start();
	// Get values passed form form in login.php file 
	$username = $_POST['user'];
	$password = md5($_POST['password']);
	
	
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
		
		
		