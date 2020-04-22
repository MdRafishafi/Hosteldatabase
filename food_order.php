<script type="text/javascript" src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

<?php

	include("includes/config.php");
	include("includes/classes/Account.php");
	include('includes/classes/Constants.php');

	$account = new Account($con);
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
  <link rel="stylesheet" href="styling/styling_student.css">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script|PT+Mono&display=swap" rel="stylesheet">

</head>
<body>


<div class="mainbody">
	<div class="header">
		<h1>Hostel Database system</h1>
	</div>
	<div class="menu">
		<a href="food_order.php" class="reference">Food Ordering</a>
		<a href="student_profile.php" class="reference">Student Profile</a>
		<a href="visitors_list.php" class="reference">Visitors list</a>
		<a href='logout.php'  name='logout' class='reference'>Logout</a>
	</div>
	<div class="content" >
<form id="foodOrderForm" action="food_order.php"  method="post">
	<?php include("includes/handlers/food-handler.php"); ?>
		<div class="dropdownmenu">
			<?php echo $account->getError(Constants::$choice); ?><br>
		Breakfast
		<select name="breakfastorder">
		<option>Select any one</option>
		<?php
		$foodtable="breakfast";
		$account->drop_down_menu($foodtable);
		 ?>
		 </select>
		 </div>
		 <div class="dropdownmenu">
		 	<?php echo $account->getError(Constants::$choice); ?><br>
		 Lunch
		 <select name="lunchorder">
		<option>Select any one</option>
		<?php
		$foodtable="lunch";
		$account->drop_down_menu($foodtable);
		 ?>
		 </select>
		</div>
		<div class="dropdownmenu">
			<?php echo $account->getError(Constants::$choice); ?><br>
		 Snacks
		 <select name="snackorder">
		<option>Select any one</option>
		<?php
		$foodtable="snacks";
		$account->drop_down_menu($foodtable);
		 ?>
		 </select>
		</div>
		<div class="dropdownmenu">
			<?php echo $account->getError(Constants::$choice); ?><br>
		 Dinner
		 <select name="dinnerorder">
		<option>Select any one</option>
		<?php
		$foodtable="dinner";
		$account->drop_down_menu($foodtable);
		 ?>
		 </select>
		 </div>

<button  type="submit" id="foodorder" name="foodorder">Order Food</button>

</form>
</div>
</div>


</body>
</html>
