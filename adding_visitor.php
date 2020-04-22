<script type="text/javascript" src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
<?php

	include("includes/config.php");
	include("includes/classes/Account.php");
	include('includes/classes/Constants.php');
	
	$account = new Account($con);

	
	 // session_destroy();
	if (isset($_SESSION['adminLoggedIn'])) {
	$adminLoggedIn = $_SESSION['adminLoggedIn'];
	}else{
		header("Location:admin_login.php");
	}
	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
 ?>

<style type="text/css">
    input{
        border: none;
        border-bottom: 2px solid;
        text-align: center;

    }
     .inputstyle{
    	width: 15em;
    }
    textarea{
        border: none;
        border-bottom: 2px solid;
        text-align: center;
    }
    p{
        margin-bottom: 20px;
    }
</style>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Hostel Database</title>
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



	 <div id="visitorInfo">
		 <form id="visitorForm" action="adding_visitor.php" method="post">
		 	<?php 
		 				if (isset($_POST['visit'])) {
						//login button is pressed
	
						$studentName = $_POST['studentName'];
						$studentUSN = $_POST['studentUSN'];
						$studentUSN = strtoupper($studentUSN);
						$visitorPhoneNumber = $_POST['visitorPhoneNumber'];
						$visitorName = $_POST['visitorName'];
						

						$account->addingvisitor($studentName,$studentUSN,$visitorPhoneNumber,$visitorName);

	
			}
		 	 ?>
			 <h2>Visitor Details</h2>
			 <p>
				 <?php echo $account->getError(Constants::$userNameLength); ?>
<!--				 <label for="studentName">Student Name</label>-->
				 <input id="studentName" class="inputstyle"  type="text" name="studentName" placeholder="Student Name" required="">
			 </p>
			 <p>
				 <?php echo $account->getError(Constants::$USNLength); ?>
				 <?php echo $account->getError(Constants::$USNDOExist); ?>
<!--				 <label for="studentUSN">Student USN</label>-->
				 <input id="studentUSN" class="inputstyle"  type="text" name="studentUSN" placeholder="Student USN"   required="">
			 </p>

			 <p>
				 <?php echo $account->getError(Constants::$phoneNumberLength); ?>
<!--				 <label for="visitorPhoneNumber">Visitor Phone number</label>-->
				 <input type="number" class="inputstyle"   name="visitorPhoneNumber" id="visitorPhoneNumber" placeholder="Visitor Phonenumber"   required="">
			 </p>

			 <p>
				 <?php echo $account->getError(Constants::$userNameLength); ?>
<!--				 <label for="visitorName">Visitor name</label>-->
				 <input id="visitorName" class="inputstyle"  type="text" name="visitorName" placeholder="Visitor name" required="">
			 </p>
			 <button type="submit" name="visit">Visit</button>
		 </form>
	 </div>

 </body>
 </html>
