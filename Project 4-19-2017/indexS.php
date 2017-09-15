
<?php
 session_start();


?>








<html>
<head>
	<title>Courses</title>

	<style>


#logout{
	float: right;	
}	

	</style>



</head>
<body>
<?php

	if(!isset($_SESSION['username']))
	{
		header("Location:login.php");
	}
	
	
?>

<div id="logout">
<a href="logout.php">Logout</a>
</div>


<div id="nav">
	<b><a href="indexS.php" target="_blank">Home</a> &nbsp; </b>
	<b><a href="coursesS.php" target="_blank">Courses</a> &nbsp; </b>

</div>

<br>
<br>

<h1> Welcome! </h1>


<?php

echo "Welcome " . $_SESSION["username"] . ".";
?>
 




	
</body>
</html>


