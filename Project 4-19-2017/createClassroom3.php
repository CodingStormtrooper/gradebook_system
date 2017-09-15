<?php
	session_start();
	
	$courseTitle = $_SESSION['courseTitle'];
	
	echo $courseTitle;
	//connect to database 
	 $db = mysqli_connect("localhost", "root", "", "Gradebook");

	

	
	if (isset($_POST['register_btn'])) {
		$section = mysql_real_escape_string($_POST['section']);
		$percentage = mysql_real_escape_string($_POST['percentage']);
		
		

		
		if($courseTitle == "")		{
			echo "Please enter in a valid Course Title!";
 			} else{
				$sql = "INSERT INTO CourseSection (courseTitle, section, percentage) VALUES ('$courseTitle', '$section', '$percentage')";	
				$result = mysqli_query($db, $sql);
		}
	}
		
	else{  
		// failed 
		echo "failed";
		}
		


?>




<html>
<head>
	<title>Create Course Sections</title>

	<style>


	#logout{
	float: right;	
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


<h1>Create Course Sections</h1> 


	<form method="post" action="createCourse2.php">
//sections = 100%
	<div>
		<table>
			<tr> 
				<td> Add Student   </td>
				<td><input type="text" name="studensName" class"textInput"></td>
				
			</tr>
			<tr> 
				<td><input type="submit" name="register_btn" class="Register"></td>
			</tr>

		</table>
		
		

	</div>

</form>



	
</body>
</html>