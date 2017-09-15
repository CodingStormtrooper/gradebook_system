<?php
	session_start();
	
	$username = $_SESSION['username'];
	
	//connect to database 
	 $db = mysqli_connect("localhost", "root", "", "Gradebook");

	
	if (isset($_POST['register_btn'])) {
		$courseTitle = mysql_real_escape_string($_POST['courseTitle']);
		$section = mysql_real_escape_string($_POST['section']);
		$percentage = mysql_real_escape_string($_POST['percentage']);
		$studentName = mysql_real_escape_string($_POST['studentName']);
		
		$sql1="SELECT * FROM course WHERE courseTitle='$courseTitle'";
		$result1 =mysqli_query($db, $sql1);
		
	

		// Mysql_num_row is counting table row
		$count=mysqli_num_rows($result1);
		
		// If result matched $username and $password, table row must be 1 row
		if($count>0){
    		echo "CourseTitle already exists";
    	}
    	elseif($studentName == "")		{
			echo "Please enter in a valid Course Title!";
 			} 
    	
		else{
			if($courseTitle == "")		{
			echo "Please enter in a valid Course Title!";
 			} else{
				$sql = "INSERT INTO course (username, courseTitle) VALUES ('$username', '$courseTitle')";	
				$result = mysqli_query($db, $sql);
				
				$sql1 = "INSERT INTO CourseSection (courseTitle, section, percentage) VALUES ('$courseTitle', '$section', '$percentage')";	
				$result1 = mysqli_query($db, $sql1);
				
				
				$_SESSION ['courseTitle'] = $courseTitle;
				
				$sql2= "SELECT * FROM CourseSection WHERE courseTitle='$courseTitle' ";
 		// Mysql_num_row is counting table row
				$result2 =mysqli_query($db, $sql2);
	
			$count=mysqli_num_rows($result2);
		
		// If result matched $username and $password, table row must be 1 row
				if($count>0){
		
					$data = array();
					$data1 = array();
		
     			// output data of each row
     			while($row = mysqli_fetch_array($result2)) {

     				$data[] = $row["section"];
     				$data1[] = $row["percentage"];
     				$json_Array = json_encode($data);
     				$json_Array1 = json_encode($data1);
         		}
        		}
        		$sql3 = "INSERT INTO courseregister (courseTitle, studentName) VALUES ('$courseTitle', '$studentName')";	
				$result3 = mysqli_query($db, $sql3);
  				
  				
  				
  				
  				$sql4="SELECT studentName FROM courseregister WHERE courseTitle='$courseTitle'";
 		// Mysql_num_row is counting table row
				$result4 =mysqli_query($db, $sql4);
	
				$count4=mysqli_num_rows($result4);
		
		// If result matched $username and $password, table row must be 1 row
				if($count4>0){
		
				$data4 = array();
		
		
     // output data of each row
     			while($row = mysqli_fetch_array($result4)) {

     			$data4[] = $row["studentName"];
     			$json_Array4 = json_encode($data4);
         //echo "<br>" . "Course Title: " .  $row["courseTitle"];
         
         //link every page to courseHome... with courseid in session
         //load coursePage based on courseID 
         
       //  $link = "courseHomepageT.php";
         
         }
        }


				//header("location: createCourse2.php"); 
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

	<form method="post" action="createCourse.php">

	<div id="createCourse">
		<table>
			<tr> 
				<td>Course Title</td>	
				<td><input type="text" name="courseTitle" class="textInput"></td>
			</tr>


		</table>
		
		

	</div>

</form>

<div id="header"
<h1>Create Course Sections</h1> 
<div>

<form method="post" action="createCourse.php">
//sections = 100%
	<div>
		<table>
			<tr> 
				<td>Course Sections  </td>	
				<td><input type="text" name="section" class="textInput"></td>
				<td> Percentage   </td>
				<td><input type="number" name="percentage" class="textInput"></td>
				
			</tr>

		</table>
		
		

	</div>

</form>



<script type="text/javascript">   
 	var name = '<?php echo $json_Array; ?>';
     //document.write(name);
    var newName = JSON.parse(name);
     	var name1 = '<?php echo $json_Array1; ?>';
     //document.write(name);
    var newName1 = JSON.parse(name1);
    //document.write(newName); 
    
    for( var i=0; i<newName.length; i++) {
    	



    	//document.write("<a href='courseHomepageT.php' id='link'>  CourseTitle  </a> " );
    	document.write(newName[i]);
    	document.write('&nbsp;');
    	document.write(newName1[i]);
    	document.write('%');
    	document.write('<br>');
    	
    }
</script>   






<h1>Add Students to Class</h1> 


<form method="post" action="createCourse.php">
// on submit show students entered.... 
	<div>
		<table>
			<tr> 
				<td> Add Student   </td>
				<td><input type="text" name="studentName" class"textInput"></td>
				
			</tr>
			<tr> 
				<td><input type="submit" name="register_btn" class="Register"></td>
			</tr>

		</table>
		
		

	</div>

</form>
<h2>Students in class: </h2>



<script type="text/javascript">   
    var name4 = '<?php echo $json_Array4; ?>';
    //document.write(name);
    var newName = JSON.parse(name);
    //document.write(newName); 
    
    for( var i=0; i<newName.length; i++) {
    	



    	//document.write("<a href='courseHomepageT.php' id='link'>  CourseTitle  </a> " );
    	document.write(newName[i]);
    	document.write('<br>');
    	
    }
</script>     
         
	
</body>
</html>