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

	<div id="userInfo" class="userinfo">
		<form id="registrationForm" action="registration.php" method="post">
			<?php 
			include("includes/handlers/register-handler.php");
			 ?>
			<h2 class="studentdetlies">Student Registration</h2>
			<p>
				<?php echo $account->getError(Constants::$lastNameLength); ?>
				<?php echo $account->getError(Constants::$firstNameLength); ?><br>
				
				<input id="userFirstName" type="text" placeholder="First name" name="userFirstName" value="<?php getInputValue('userFirstName') ?>" required="" >
			
				
				<!-- <label for="userLastName">Last name</label> -->
				<input id="userLastName" type="text" name="userLastName" placeholder="Last name" value="<?php getInputValue('userLastName') ?>"  required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$userNameLength); ?><br>
<!--				<label for="userName">Name</label>-->
				<input id="userName" type="text" name="userName" placeholder="Name" value="<?php getInputValue('userName') ?>" required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$USNLength); ?>
				<?php echo $account->getError(Constants::$USNExist); ?><br>
<!--				<label for="useUSN">USN</label>-->
				<input id="userUSN" type="text" name="userUSN"  placeholder="USN" value="<?php getInputValue('userUSN') ?>" required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$emailInvalid); ?>
				<?php echo $account->getError(Constants::$mailExist); ?><br>
<!--				<label for="userMail">Mail ID</label>-->
				<input type="email" name="userMail" id="userMail" placeholder="Mail ID"  value="<?php getInputValue('userMail') ?>" required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$phoneNumberLength); ?><br>
<!--				<label for="userPhoneNumber">Phone number</label>-->
				<input type="number"  name="userPhoneNumber" id="userPhoneNumber" placeholder="Phone number" value="<?php getInputValue('userPhoneNumber') ?>"  required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$addressLength); ?>
				<?php echo $account->getError(Constants::$addressInvalid); ?><br>
<!--				<label for="userAddress">Address</label>-->
				<textarea name="userAddress" id="userAddress" rows="3"  placeholder="Address" value="<?php getInputValue('userAddress') ?>" cols="30" ></textarea>
			</p>
			<p>
				<?php echo $account->getError(Constants::$userNameLength); ?><br>
<!--				<label for="userParentName">Parent/Garden name</label>-->
				<input id="userParentName" type="text" name="userParentName" placeholder="Parent/Garden name" value="<?php getInputValue('userParentName') ?>" required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$phoneNumberLength); ?><br>
<!--				<label for="userParentNumber">Parent/Garden phone number</label>-->
				<input id="userParentNumber"  type="number" placeholder="Parent/Garden phone number"  value="<?php getInputValue('userPhoneNumber') ?>" name="userParentNumber"required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$roomNumberInvalid); ?><br>
<!--				<label for="userRoomNumber">Room Number</label>-->
				<input type="number" name="userRoomNumber" placeholder="Room Number" value="<?php getInputValue('userRoomNumber') ?>"  id="userRoomNumber">
			</p>
			<p>
				<?php echo $account->getError(Constants::$passwordDoNotMAtch); ?>
				<?php echo $account->getError(Constants::$passwordLength); ?><br>
<!--				<label for="userPassword">Password</label>-->
				<input id="userPassword" type="password" placeholder="Password"  name="userPassword"required="">
			</p>
			<p>
<!--				<label for="userConfirmPassword">Retype password</label>-->
				<input id="userConfirmPassword" placeholder="Retype password" type="password" name="userConfirmPassword" required="">
			</p>
			<button type="submit" name="siginup">Create New Student</button>
		</form>
	</div>

</body>
</html>
