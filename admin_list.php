<?php


	include("includes/config.php");
	// session_destroy();
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
		<?php 
			$sqlquery = mysqli_query($con , "SELECT designation FROM admin WHERE mail_id='$adminLoggedIn'");
			if (mysqli_num_rows($sqlquery)>0) {
						$row = mysqli_fetch_assoc($sqlquery);
						$admindesignation = $row['designation'];
			}
			// echo strcmp($admindesignation,"accountant");
			if (!strcmp($admindesignation,"canteen")) {
				echo "<a href='admin_profile.php' class='reference'>Profile</a>";
				echo "a href='adding_food_menu.php' class='reference'>Food Menu</a>";
				echo "a href='food_ordered_list.php' class='reference'>Food Ordered List</a>";
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
	</div>


<?php 
			$sqlquery = mysqli_query($con , "CALL `alladmin`();");
			// print_r($sqlquery);
			if (mysqli_num_rows($sqlquery)>0) {
						while ($row = mysqli_fetch_assoc($sqlquery)) {
						$name = $row['name'];
						$phone_number = $row['phone_number'];
						$designation = $row['designation'];
						$date = $row['date'];

						echo "<div class='card mb-3' style='border: 2px solid;
 															 border-radius: 12px;' >
							  <div class='row no-gutters'>
							    <div class='col-md-4'>
							      <img src='assets/images/profile-pics/download.png' class='card-img' style='width: 50%; height: 80%;'>
							    </div>
							    <div class='col-md-8'>
							      <div class='card-body'>
							        <h5 class='card-title'>$name</h5>
							        <p class='card-text'>
							        	Phone Number : $phone_number <br>
							        	Designation : $designation <br>
							        </p>
							        <p class='card-text'><small class='text-muted'>Joined date $date</small></p>
							      </div>
							    </div>
							  </div>
							</div>";
						
					}
			}
 ?>

<!-- 
 <div class="">
 	Admin List
	name <br>
	designation <br>
	phone number <br> -->
 </div>
 </body>
 </html>
