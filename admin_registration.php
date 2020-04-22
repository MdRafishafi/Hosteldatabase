<script type="text/javascript" src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
<?php
	include("includes/config.php");
	

	
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
    .inputstyle{
    	width: 15em;
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

	<div id="adminInfo" class="userinfo">
		<form id="adminRegistrationForm" action="admin_registration.php" method="post">
			<?php 
					include("includes/classes/Account.php");
					include('includes/classes/Constants.php');

					$account = new Account($con);
					include("includes/handlers/admin_register-handler.php"); ?>
			<h2>Create an new Admin</h2>
			<p>
				<?php echo $account->getError(Constants::$userNameLength); ?><br>
<!--				<label for="adminName">Name</label>-->
				<input id="adminName" class="inputstyle" type="text" placeholder="Name" name="adminName" value="<?php getInputValue('adminName') ?>" required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$emailInvalid); ?>
				<?php echo $account->getError(Constants::$mailExist); ?><br>
<!--				<label for="adminMail">Mail ID</label>-->
				<input type="email" class="inputstyle" name="adminMail" id="adminMail" placeholder="Mail ID" value="<?php getInputValue('adminMail') ?>" required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$userNameLength); ?><br>
<!--				<label for="adminDesignation">Designation</label>-->
				<input id="adminDesignation" type="text" class="inputstyle" name="adminDesignation" placeholder="Designation" value="<?php getInputValue('adminDesignation') ?>" required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$phoneNumberLength); ?><br>
<!--				<label for="adminPhoneNumber">Phone number</label>-->
				<input type="number"  name="adminPhoneNumber" class="inputstyle" id="adminPhoneNumber" placeholder="Phone number" value="<?php getInputValue('adminPhoneNumber') ?>"  required="">
			</p>
			<p>
				<?php echo $account->getError(Constants::$passwordDoNotMAtch); ?><br>
				<?php echo $account->getError(Constants::$passwordLength); ?>
<!--				<label for="adminPassword">Password</label>-->
				<input id="adminPassword" class="inputstyle" type="password" placeholder="Password" name="adminPassword"required="">
			</p>
			<p>
<!--				<label for="adminConfirmPassword">Retype password</label>-->
				<input id="adminConfirmPassword" class="inputstyle" type="password" placeholder="Retype password" name="adminConfirmPassword" required="">
			</p>
			<button type="submit" name="adminsiginup">Create New Admin</button>
		</form>
	</div>

</body>
</html>
