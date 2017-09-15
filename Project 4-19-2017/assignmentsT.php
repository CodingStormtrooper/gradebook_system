<?php


session_start();



$courseTitle = $_GET['courseTitle'];
$_GET['courseTitle'];

//connect to database 
$db = mysqli_connect("localhost", "root", "", "Gradebook");
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
    	var courseTitle = '<?php echo $courseTitle ?>'
    	document.write(courseTitle.link("courseHomepageT.php?courseTitle=" + courseTitle));
    	document.write('&nbsp;');
    	var CN = "Create Assignment";
    	var courseTitle = '<?php echo $courseTitle ?>'
    	document.write(CN.link("createAssignments.php?courseTitle=" + courseTitle));

	</script>     
	


</div>


<div class="header"> 
<h1>Assignments</h1>
</div>

<?php

 	 $db = mysqli_connect("localhost", "root", "", "Gradebook");
 

	$sql="SELECT * FROM assignments WHERE courseTitle='$courseTitle'";
 		// Mysql_num_row is counting table row
	$result =mysqli_query($db, $sql);
	
	$count=mysqli_num_rows($result);
		
		// If result matched $username and $password, table row must be 1 row
		if($count>0){
		
			$data = array();
			$data1 = array();

     // output data of each row
     		while($row = mysqli_fetch_array($result)) {

     			$data[] = $row["assignment_name"];
     			$json_Array = json_encode($data);

     		}	
     	
     	}
     	
     	else{
     	 echo "No assignments created" ;
     	 }
     	
    
    ?>

  
<script type="text/javascript">   
    var name = '<?php echo $json_Array; ?>';
  

	
    var newName = JSON.parse(name);

    //document.write(newName); 
    
    for( var i=0; i<newName.length; i++) {
    	



    	//document.write("<a href='courseHomepageT.php' id='link'>  CourseTitle  </a> " );
    	document.write(newName[i].link("gradebook.php?assignment_name=" + newName[i]));
    	document.write('<br>');
   
    	
    }
</script>     

	
</body>
</html>