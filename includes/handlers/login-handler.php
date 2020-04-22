<?php 
if (isset($_POST['login'])) {
	//login button is pressed
	
	$userMail = $_POST['loginMail'];
	$userpasword = $_POST['loginPassword'];

	// Login functionin
	$result = $account->login($userMail,$userpasword);
	if ($result == true) {
		$_SESSION['userLoggedIn'] = $userMail;
		header("Location:food_order.php");
	}
}
 ?>