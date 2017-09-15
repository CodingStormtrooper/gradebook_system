<?php
//include "core/int.php";
//include "includes/overall/header.php";


session_start();
//include 'function.php';
//echo "Welcome " . $_SESSION['username'];

?>



<html>
<head>
	<title>index_T</title>

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
	<b><a href="indexT.php">Home</a> &nbsp; </b>
	<b><a href="coursesT.php">Courses</a> &nbsp; </b>
</div>

<div class="header"> 
<h1>Teachers Lounge</h1>
</div>

<?php

echo "Welcome " . $_SESSION["username"] . ".";
?>



	
</body>
</html>Í