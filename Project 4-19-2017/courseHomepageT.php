
<?php

session_start();
$_GET['courseTitle'];


$courseTitle = $_GET['courseTitle'];

$_SESSION['courseTitle'] = $courseTitle;

?>




<html>
<head>
	<title>Handouts</title>

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
<script type="text/javascript">  
		var assignment = "Assignments" 
    	var courseTitle = '<?php echo $courseTitle ?>'
    	document.write(assignment.link("assignmentsT.php?courseTitle=" + courseTitle));

</script>     
		<b><a href="handoutsT.php">Handouts</a> &nbsp; </br>
	</div>
	<br>
	<br>

<h1>Course



<?php


echo "$courseTitle" 
?>
 Homepage</h1> 

	<div id="editCourse">
	<a href="editCourseSection.php">EditCourse</a>
	</div>
<br>
<br>
<?php

 	 $db = mysqli_connect("localhost", "root", "", "Gradebook");
 

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