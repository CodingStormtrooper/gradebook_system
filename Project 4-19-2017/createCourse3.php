<?php
	session_start();
	
	$courseTitle = $_SESSION['courseTitle'];
	
	echo $courseTitle;
	//connect to database 
	 $db = mysqli_connect("localhost", "root", "", "Gradebook");

	

	
	if (isset($_POST['register_btn'])) {
		$studentName = mysql_real_escape_string($_POST['studentName']);
		
		

		
		if($studentName == "")		{
			echo "Please enter in a valid Course Title!";
 			} else{
				$sql = "INSERT INTO courseregister (courseTitle, studentName) VALUES ('$courseTitle', '$studentName')";	
				$result = mysqli_query($db, $sql);
				$_SESSION['courseTitle'] = $courseTitle;
				header("location: createCourse3.php"); 
		
	}
	}
	else{  
		// failed 
		echo "failed";
		}
		
		
		
		
	$sql1="SELECT studentName FROM courseregister WHERE courseTitle='$courseTitle'";
 		// Mysql_num_row is counting table row
	$result1 =mysqli_query($db, $sql1);
	
	$count=mysqli_num_rows($result1);
		
		// If result matched $username and $password, table row must be 1 row
		if($count>0){
		
		$data = array();
		
		
     // output data of each row
     	while($row = mysqli_fetch_array($result1)) {

     		$data[] = $row["studentName"];
     		$json_Array = json_encode($data);
         //echo "<br>" . "Course Title: " .  $row["courseTitle"];
         
         //link every page to courseHome... with courseid in session
         //load coursePage based on courseID 
         
       //  $link = "courseHomepageT.php";
         
         }
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


	<form method="post" action="createCourse3.php">
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
    var name = '<?php echo $json_Array; ?>';
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