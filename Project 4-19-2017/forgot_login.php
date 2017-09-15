<html>

<head>

</head>

<body>


<?php

if(isset($_POST['send'])) {
	$email = $_POST['email'];

	
	
	$email = strip_tags($_POST['email']);

	
	//connect to the server and select database 
	mysql_connect("localhost", "root", "");
	mysql_select_db("Gradebook");




//


$email_check = mysql_query("SELECT * FROM users WHERE email= ' ".$email."'");
$count = mysql_num_rows($email_check);

if ($count != 0) {
//generate new password
$random = rand(72891, 92729);
$new_password = $random;


//create a copy of the new password 
$email_password = $new_password;


//encrypt the new password 
$new_password = md5($new_password);

//update the db 
mysql_query("update users set password = '".$new_password."' ");

//send the password to the user 
$subject = "Login Information";
$message = "Your password has been changed to $email_password";
$from = "From: example@example.com";

mail($email, $subject, $message, $from);
echo "Your new password has been emailed to you.";



}


else{
	echo "This email does not exist.";


}

}
?>



<form action="" method="POST">
Your Email:<br /><input type="text" name="email" size="30" /><br />
<input type="submit" name="send" value="submit" />
</form>

</body>
</html>
