<?php


	include("includes/config.php");
	
	if (isset($_SESSION['adminLoggedIn'])) {
	$adminLoggedIn = $_SESSION['adminLoggedIn'];
	}else{
		header("Location:admin_login.php");
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
	<form action="student_list.php"  method="post">
		<?php 
			$sqlquery = mysqli_query($con , "SELECT designation FROM admin WHERE mail_id='$adminLoggedIn'");
			if (mysqli_num_rows($sqlquery)>0) {
						$row = mysqli_fetch_assoc($sqlquery);
						$admindesignation = $row['designation'];
			}
			// echo strcmp($admindesignation,"accountant");
			if (!strcmp($admindesignation,"canteen")) {
				echo "<a href='admin_profile.php' class='reference'>Profile</a>";
				echo "<a href='adding_food_menu.php' class='reference'>Food Menu</a>";
				echo "<a href='food_ordered_list.php' class='reference'>Food Ordered List</a>";
			}else if (!strcmp($admindesignation,"security")) {
				echo "<a href='admin_profile.php' class='reference'>Profile</a>";
				echo "<a href='adding_visitor.php' class='reference'>Visitor</a>";
			}else{
				echo "<a href='admin_profile.php' class='reference'>Profile</a>";
				echo "<a href='registration.php' class='reference'>Student Registration</a>";
				echo "<a href='admin_registration.php' class='reference'>Admin Registration</a>";
				echo "<a href='admin_list.php' class='reference'>Admin List</a>";
				echo "<a href='student_list.php' class='reference'>Student List</a>";
				
			}
			echo "<a href='admin_logout.php'  name='logout' class='reference'>Logout</a>";
		 ?>
		 
		</form>
	</div>




<?php 
			$sqlquery = mysqli_query($con , "CALL `food_order`();");
			// print_r($sqlquery);
			if (mysqli_num_rows($sqlquery)>0) {
						while ($row = mysqli_fetch_assoc($sqlquery)) {
						$user_name = $row['user_name'];
						$breakfast = $row['breakfast'];
						$lunch = $row['lunch'];
						$snacks = $row['snacks'];
						$dinner = $row['dinner'];
						$id = $row['id'];
						$date = $row['date'];
						echo "<div class='card' style='border: 2px solid;
 								border-radius: 12px;'>
							  	<div class='container'>
							    <h4><b>$user_name</b></h4>
							    <p>Breakfast:$breakfast</p>
							    <p>Lunch:$lunch</p>
							    <p>Snacks:$snacks</p>
							    <p>Dinner:$dinner</p>
							    <p>Date:$date</p>
							    
							  	</div>
								</div>";
						
					}
			}



 ?>
 </body>
 </html>
