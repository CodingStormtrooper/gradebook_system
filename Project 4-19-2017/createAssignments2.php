<?php

session_start();
$courseTitle = $_SESSION['courseTitle'];
$assignmentName = $_SESSION['assignment_name'];
echo $assignmentName; 

 	 $db = mysqli_connect("localhost", "root", "", "Gradebook");
 

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
			echo $assignmentID;
	
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
      		}
         	
     

?>








    }
</script> 


	




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
<h1>Add Students to Assignment</h1>
</div>

<br>

#list of students in class 

<h2>Students in class: </h2>



<script type="text/javascript">   
    var name = '<?php echo $data; ?>';
    //document.write(name);
    document.write(name);
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