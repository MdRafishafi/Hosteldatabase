<?php
if (isset($_POST['foodorder'])) {
	//login button is pressed
	$breakfastorderid= $_POST['breakfastorder'];
	$lunchorderid = $_POST['lunchorder'];
	$snackorderid =$_POST['snackorder'];
	$dinnerorderid = $_POST['dinnerorder'];
	$result = $account->orderfood($breakfastorderid,$lunchorderid,$snackorderid,$dinnerorderid,$userLoggedIn);
	// echo $result;
	if (strcmp($result ,"true")) {
	// echo "Order places";
	}
}
 ?>
