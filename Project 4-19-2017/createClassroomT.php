<?php
	session_start();
	
	$username = $_SESSION['username'];
	
	//connect to database 
	 $db = mysqli_connect("localhost", "root", "", "Gradebook");

	
	if (isset($_POST['register_btn'])) {
		$courseTitle = mysql_real_escape_string($_POST['courseTitle']);
		$sql1="SELECT * FROM course WHERE courseTitle='$courseTitle'";
		$result1 =mysqli_query($db, $sql1);

		// Mysql_num_row is counting table row
		$count=mysqli_num_rows($result1);
		
		// If result matched $username and $password, table row must be 1 row
		if($count>0){
    		echo "Username already exists";
    	}
		else{
			if($courseTitle == "")		{
			echo "Please enter in a valid Course Title!";
 			} else{
				$sql = "INSERT INTO course (username, courseTitle) VALUES ('$username', '$courseTitle')";	
				$result = mysqli_query($db, $sql);
				$_SESSION['courseTitle'] = $courseTitle;
				header("location: createCourse2.php"); 
				}
		}
	}
	

?>




<html>
<head>
	<title>Create New Class Room</title>


	<style>
		body {
			background-color: lightblue;
		}
		#logout{
		float: right;
		color: white;	
		}
		
		#topWelcome{
			background-color: blue;
			color: white;
    		text-align: center;
		}
		
		#header{
			text-align: center;
		}
		
		#createCourse{
			border: 1px solid black;
    		margin-top: 100px;
    		margin-bottom: 100px;
    		margin-right: 150px;
    		margin-left: 80px;
    		background-color: lightgrey;
		}
	</style>


</head>
<body>
<div id="logout">
<a href="logout.php">Logout</a>
</div>

<div id="nav">
	<b><a href="indexT.php">Home</a> &nbsp; </b>
	<b><a href="coursesT.php">Courses</a> &nbsp; </b>
</div>

<div id="header">
<h1>Create new Classroom</h1> 
</div>

	<form method="post" action="createClassroomT.php">

	<div id="createCourse">
		<table>
			<tr> 
				<td>Course Title</td>	
				<td><input type="text" name="courseTitle" class="textInput"></td>
			</tr>
			<tr> 
				<td><input type="submit" name="register_btn" class="Register"></td>
			</tr>

		</table>
		
		

	</div>

</form>



	
</body>
</html>