<?php
session_start();
$username = $_SESSION['username'];

?>

<html>
<head>
	<title>Courses</title>

	

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
<h1>Courses: </h1>
 </div>

<?php

 	 $db = mysqli_connect("localhost", "root", "", "Gradebook");
 

	$sql="SELECT * FROM course WHERE username='$username'";
	
 	// Mysql_num_row is counting table row
	$result =mysqli_query($db, $sql);
	$count=mysqli_num_rows($result);
		
		// If result matched $username and $password, table row must be 1 row
		if($count>0){
			$data = array();
		
     		// output data of each row
     		while($row = mysqli_fetch_array($result)) {
     			$data[] = $row["courseTitle"];
     			$json_Array = json_encode($data);
         	}
        }
        
        else{
        	echo "No courses to show";
        }
?>

<script type="text/javascript">   

    var name = '<?php echo $json_Array; ?>';
    var newName = JSON.parse(name);
    for( var i=0; i<newName.length; i++) {
    	document.write(newName[i].link("courseHomepageT.php?courseTitle=" + newName[i]));
    	document.write('<br>');
    }
</script>     
        


	<div id="createClass">
	<br><b><a href="createClassroomT.php">create new classroom</a> &nbsp; </b> 
	</div>

</body>
</html>