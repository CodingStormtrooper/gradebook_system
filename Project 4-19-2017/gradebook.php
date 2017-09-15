<?php
session_start();
$courseTitle = $_SESSION['courseTitle'];

$_GET['assignment_name'];



$assignmentName = $_GET['assignment_name'];



?>

<html>
<head>
	<title>CourseWork</title>

	

	<style>
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

		#studentName {
		
		
		}
		
		AssignmentName {
		
			
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
<br>
<br>

<div id="header">
<h1> CourseWork </h1>
 </div>






<?php 	

 $db = mysqli_connect("localhost", "root", "", "Gradebook");


	$fetch = "SELECT assignment_id FROM assignments WHERE assignment_name='$assignmentName'";
	
	$result1 = mysqli_query($db, $fetch) or die(mysqli_error($db));
		while ($row1 = $result1->fetch_assoc()) {
			$assignmentId = $row1['assignment_id'];
	
		}
		
	$fetchs = "SELECT total_score FROM assignments WHERE assignment_id='$assignmentId'";
	
	$results = mysqli_query($db, $fetchs) or die(mysqli_error($db));
		while ($rows = $results->fetch_assoc()) {
			$totalScore = $rows['total_score'];
	}
 
	$sql = "SELECT courseregister.studentName, grades.grade FROM courseregister LEFT JOIN grades ON courseregister.registerid=grades.registerid WHERE grades.assignment_id='$assignmentId'" ;
 		// Mysql_num_row is counting table row
		$result =mysqli_query($db, $sql) or die(mysqli_error($db));
		
		$count=mysqli_num_rows($result);
		
		// If result matched $username and $password, table row must be 1 row
		if($count>0){
	
		//echo "shows students name and grade for earned for assignment" ;
     // output data of each row
     		while($row = mysqli_fetch_assoc($result)) {
     			if ( $row['grade'] != null ){
     				$assignmentScore = $row['grade'] /  $totalScore;
     				echo $row['grade'];
     				echo $row['studentName']. "-" . round((float)$assignmentScore * 100). '%' ;
     				echo "<br/>"; 
     			}else {
     				echo $row['studentName']. "-". $row['grade'];
     			
     			}
     	
         //echo "<br>" . "Course Title: " .  $row["courseTitle"];
         
         //link every page to courseHome... with courseid in session
         //load coursePage based on courseID 
         
       //  $link = "courseHomepageT.php";
         
         }
         }

?>




 <div id="assignmentName">
	<h2> Assigment  </h2>
	<h2>Students in class: </h2>
	<script type="text/javascript">   

  
    	
	</script>     
</div>

<?php

	
?>



<div id="studentName">

    <script type="text/javascript">
    
    	
    	var obj = '<?php echo json_encode($totalScore); ?>';
		var obj = JSON.parse(obj);
		document.write(obj);
	</script> 



    
</div>    


</body>
</html>