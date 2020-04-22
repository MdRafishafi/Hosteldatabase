<?php 

include("includes/config.php");

// session_destroy();


if (isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
	// echo "Student Logined";
}
else{
	header("Location:login.php");
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
		<a href="food_order.php" class="reference">Food Ordering</a>
		<a href="student_profile.php" class="reference">Student Profile</a>
		<a href="visitors_list.php" class="reference">Visitors list</a>
		<a href='logout.php'  name='logout' class='reference'>Logout</a>
	</div>

	<div class="studentprofil">
		<!-- <img src="assets/images/profile-pics/download.png" style="width: 10%; height: 10%;" class="profile_pic"> -->
		<?php 
		$sqlquery = mysqli_query($con , "SELECT * FROM students WHERE mail_id='$userLoggedIn'");
		if (mysqli_num_rows($sqlquery)>0) {
						$row = mysqli_fetch_assoc($sqlquery);
						$studentmailid = $row['mail_id'];
						$studentname = $row['user_name'];
						$studentusn = $row['usn'];
						$studentphone = $row['phone_number'];
						$studentaddress = $row['address'];
						$studentparentname = $row['parent_name'];
						$studentparentnumber = $row['parent_number'];
						$studentroomnumber = $row['room_number'];
			}

			echo "
    <div class='col-xl-4 col-md-6 col-sm-10 mx-auto' style='padding:50px;'>

        <!-- Profile widget -->
        <div class='bg-white shadow rounded overflow-hidden'>
            <div class='px-4 pt-0 pb-4 bg-dark'>
                <div class='media align-items-end profile-header'>
                    <div class='profile mr-3'><img src='assets/images/profile-pics/download1.png' width='130' class='rounded mb-2 img-thumbnail'></div>
                    <div class='media-body mb-5 text-white'>
                        <h4 class='mt-0 mb-0'>$studentname</h4>
                        <p class='small mb-4'> <i class='fa fa-map-marker mr-2'></i>$studentmailid</p>
                    </div>
                </div>
            </div>

            <div class='bg-light p-4 d-flex justify-content-end text-center'>
                
            </div>

            <div class='py-4 px-4'>
                <div class='py-4'>
                    <h5 class='mb-3'>Details</h5>
                    <div class='p-4 bg-light rounded shadow-sm'>
                        <p class='font-italic mb-0'>USN : $studentusn<br>
                        							Phone Number : $studentphone 
                        							Address : $studentaddress <br>
										        	Parent Name : $studentparentname <br>
										        	Parent Number : $studentparentnumber <br>
										        	Room Number : $studentroomnumber <br></p>
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

	</div>
</body>
</html>