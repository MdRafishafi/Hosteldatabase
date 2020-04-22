<?php 

include("includes/config.php");

// session_destroy();


if (isset($_SESSION['adminLoggedIn'])) {
	$adminLoggedIn = $_SESSION['adminLoggedIn'];
	}else{
		header("Location:admin_login.php");
	}


 ?>

<style type="text/css">
    .profile-header {
    transform: translateY(5rem);
}
</style>

<!DOCTYPE html>
<html>
<head>
	<title>Hostel database</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="styling/styling_student.css">
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
	</div>

	 
		
		<?php 
		$sqlquery = mysqli_query($con , "SELECT * FROM admin WHERE mail_id='$adminLoggedIn'");
		if (mysqli_num_rows($sqlquery)>0) {
						$row = mysqli_fetch_assoc($sqlquery);
						$adminmailid = $row['mail_id'];
						$adminname = $row['name'];
						$adminphone = $row['phone_number'];
						$admindesignation = $row['designation'];
			}


			echo "
    <div class='col-xl-4 col-md-6 col-sm-10 mx-auto' style='padding:50px;'>

        <!-- Profile widget -->
        <div class='bg-white shadow rounded overflow-hidden'>
            <div class='px-4 pt-0 pb-4 bg-dark'>
                <div class='media align-items-end profile-header'>
                    <div class='profile mr-3'><img src='assets/images/profile-pics/download.png' width='130' class='rounded mb-2 img-thumbnail'></div>
                    <div class='media-body mb-5 text-white'>
                        <h4 class='mt-0 mb-0'>$adminname</h4>
                        <p class='small mb-4'> <i class='fa fa-map-marker mr-2'></i>$adminmailid</p>
                    </div>
                </div>
            </div>

            <div class='bg-light p-4 d-flex justify-content-end text-center'>
                
            </div>

            <div class='py-4 px-4'>
                <div class='py-4'>
                    <h5 class='mb-3'>Details</h5>
                    <div class='p-4 bg-light rounded shadow-sm'>
                        <p class='font-italic mb-0'>Phone Number: $adminphone<br>Designation $admindesignation </p>
                    </div>
                </div>
            </div>
        </div><!-- End profile widget -->

    </div>

";

		 ?>
		




		<!--  <br>
		usn <br>
		phone <br>
		room number <br>
		parent name <br>
		parent number <br>
		change of password <br> -->

	
</body>
</html>