<?php

include("includes/config.php");

// session_destroy();


if (isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
}
else{
	header("Location:login.php");
}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Hostel database</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="styling/style.css">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script|PT+Mono&display=swap" rel="stylesheet">
</head>
<body>

<div class="header">
		<h1>Hostel Database system</h1>
	</div>
	<div class="menu">
		<a href="food_order.php" class="reference">Food Ordering</a>
		<a href="student_profile.php" class="reference">Student Profile</a>
		<a href="visitors_list.php" class="reference">Visitors list</a>
		<a href='logout.php'  name='logout' class='reference'>Logout</a>
	</div>

<?php
			$sqlquery = mysqli_query($con , "SELECT * FROM visitor WHERE usn IN (SELECT usn FROM students WHERE mail_id='$userLoggedIn');");
			// print_r($sqlquery);
			if (mysqli_num_rows($sqlquery)>0) {
						while ($row = mysqli_fetch_assoc($sqlquery)) {
						$parent_name = $row['parent_name'];
						$phone_number = $row['phone_number'];
						$date_time = $row['date_time'];

						echo "<div class='card' style='border: 2px solid;
 															 border-radius: 12px;'>
							  	<div class='container'>
							    <h4><b>$parent_name</b></h4>
							    <p>$phone_number</p>
							    <p>$date_time</p>
							  	</div>
								</div>";

					}
			}



 ?>






<!-- carder to be created -->
<!-- relation <br>
name <br>
parent name <br>
parent number <br>
student name <br>
student usn <br> -->
</body>
</html>
