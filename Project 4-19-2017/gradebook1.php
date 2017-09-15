<?php
session_start();
$courseTitle = $_SESSION['courseTitle'];



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
<h1> Gradebook </h1>
 </div>

<?php

 	 $db = mysqli_connect("localhost", "root", "", "Gradebook");
 

	$sql="SELECT * FROM courseregister WHERE courseTitle='$courseTitle'";
	
 	// Mysql_num_row is counting table row
		$result =mysqli_query($db, $sql);
		$count=mysqli_num_rows($result);
		
		// If result matched $username and $password, table row must be 1 row
		if($count>0){
			$data = array();
		
     		// output data of each row
     		while($row = mysqli_fetch_array($result)) {
     			$data[] = $row["studentName"];
     			$json_Array = json_encode($data);
         	}
        }
?>

//Writes  JSON Array CourseTitles to Screen 
<script type="text/javascript">   

    var name = '<?php echo $json_Array; ?>';
    var newName = JSON.parse(name);
    for( var i=0; i<newName.length; i++) {
    
    	document.write('<br>');
    	document.write(newName[i].link("courseHomepageT.php?courseTitle=" + newName[i]));
    	document.write('<br>');
    }
</script>     
        


</body>
</html>