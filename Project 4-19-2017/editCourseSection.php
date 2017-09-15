<?php
	session_start();
	
	$courseTitle = $_SESSION['courseTitle'];
	
	echo $courseTitle;
	//connect to database 
	 $db = mysqli_connect("localhost", "root", "", "Gradebook");

	

	
	if (isset($_POST['register_btn'])) {
		$section = mysql_real_escape_string($_POST['section']);
		$percentage = mysql_real_escape_string($_POST['percentage']);
		
		

		
		if($section == "")		{
			echo "Please enter in a valid section";
 			} else{
				$sql = "INSERT INTO CourseSection (courseTitle, section, percentage) VALUES ('$courseTitle', '$section', '$percentage')";	
				$result = mysqli_query($db, $sql);
				$_SESSION ['courseTitle'] = $courseTitle;
				header("location: createCourse3.php"); 
		
		}
	}
		
	else{  
		// failed 
		echo "failed";
		}
		


?>




<html>
<head>
	<title>Edit Course Sections</title>

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


<h1>Edit Course Sections</h1> 

<?php
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
	<form method="post" action="createCourse2.php">
//sections = 100%
	<div>
		<table>
			<tr> 
				<td>Course Sections  </td>	
				<td><input type="text" name="section" class="textInput"></td>
				<td> Percentage   </td>
				<td><input type="number" name="percentage" class="textInput"></td>
				
			</tr>
			<tr> 
				<td><input type="submit" name="register_btn" class="Register"></td>
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

<a href="createCourse3.php">Add Students</a> 

	
</body>
</html>