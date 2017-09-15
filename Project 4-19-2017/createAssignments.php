<?php



session_start();
$courseTitle = $_SESSION['courseTitle'];
	


//connect to database 
	$db = mysqli_connect("localhost", "root", "", "Gradebook");
	
if (isset($_POST['register_btn'])) {
		$assignmentName = mysql_real_escape_string($_POST['assignmentTitle']);
		$dueDate = mysql_real_escape_string($_POST['DD']);
		$totalPoints = mysql_real_escape_string($_POST['TPA']);
		$section = mysql_real_escape_string($_POST['section']);
		
	
		
		
		$sql1 =  "SELECT sectionID FROM CourseSection WHERE section='$section' ";
		$result1 = mysqli_query($db, $sql1);
		while ($row = $result1->fetch_assoc()) {
			$sectionid = $row['sectionID'];
	
		}

		
		if($assignmentName == "")		{
			echo "Please enter in a valid Assignment!";
 			}
 			
 		
 			
 			 else{
				$sql = "INSERT INTO assignments (assignment_name, courseTitle, due_date, total_score, sectionID) VALUES ('$assignmentName', '$courseTitle', '$dueDate', '$totalPoints', '$sectionid')";	
				$result = mysqli_query($db, $sql);
				$_SESSION['courseTitle'] = $courseTitle;
				$_SESSION['assignment_name'] = $assignmentName;
				
				$sql1="SELECT * FROM courseregister WHERE courseTitle='$courseTitle'";
 		// Mysql_num_row is counting table row
	
					$result1 =mysqli_query($db, $sql1);
	
					$count=mysqli_num_rows($result1);
		
					// If result matched $username and $password, table row must be 1 row
					if($count>0){
		
					$data = array();
		
		
     	// output data of each row
     					while($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)) {

     					$row_array['registerid'] = $row["registerid"];
     					$row_array['studentName'] = $row["studentName"];
			
						array_push($data, $row_array);
						}

     					echo json_encode($data);
     		
     					// assignment_name --- assignment id
     					// input assingment id and register id.... 
   	 					$sql3= "SELECT assignment_id FROM assignments WHERE assignment_name='$assignmentName' AND courseTitle='$courseTitle'";
 						// Mysql_num_row is counting table row
						$result3 = mysqli_query($db, $sql3);	
						while ($row = $result3->fetch_assoc()) {
						$assignmentID = $row['assignment_id'];
						//echo $assignmentID;
	
						}


    			
     		
     		
     		
     			
						$sql4 = "INSERT INTO grades (assignment_id, registerid) VALUES ";	

 						//$result4 =mysqli_query($db, $sql4);
      			
      			
      					$valuesArr = array();
    					foreach($data as $row){

        					$registerId = $row['registerid'];
        	
        					$valuesArr[] = "('$assignmentID', '$registerId')";
    						}

    						$sql4 .= implode(',', $valuesArr);

    						mysqli_query($db, $sql4) or exit(mysql_error());
							$_SESSION['courseTitle'] = $courseTitle;
							header ("Location: courseHomepageT.php?courseTitle=" . $courseTitle . "");
      					}
         		
				}
}
		

		


?>

	




<html>
<head>
	<title>Assignment</title>

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

	
<script type="text/javascript"> 			
var assignment = "Assignments" 
    	var courseTitle = '<?php echo $courseTitle ?>'
    	document.write(courseTitle.link("courseHomepageT.php?courseTitle=" + courseTitle));
</script>
	</div>

<div class="header"> 
<h1>Create Assignment</h1>
</div>

<br>
<form method="post" action="createAssignments.php">
		
	<div>
		<table>
			<tr> 
				<td>Assignment Name:</td>	
				<td><input type="text" name="assignmentTitle" class="textInput"></td>
			</tr>
		
			<tr> 
				<td>Due Date:</td>	
				<td><input type="date" name="DD" class="textInput"></td>
			</tr>
			<tr> 
				<td>Total Points Available</td>	
				<td><input type="" name="TPA" class="textInput"></td>
			</tr>
			
			<tr>
				<td>Section: </td>	
			<td>	
			<?php 
			
			$sql1= "SELECT * FROM CourseSection WHERE courseTitle='$courseTitle' ";
 		// Mysql_num_row is counting table row
			$result1 =mysqli_query($db, $sql1);
	
			$count=mysqli_num_rows($result1);
		
		// If result matched $username and $password, table row must be 1 row
			if($count>0){
		
			
				echo "<select name='section'>
     			<option value=''>Select a state</option>";
     			while($row = mysqli_fetch_array($result1)) {		
			
 	
				echo "<option value='$row[section]'>$row[section]</option>";
				
				
				}
			}
			
			echo "</select>";
			?>
			

	</td>				
			</tr>
			
	
			<tr> 
				<td><input type="submit" name="register_btn" class="Register"></td>
			</tr>

		</table>
	</div>
	
	</form>




	
</body>
</html>