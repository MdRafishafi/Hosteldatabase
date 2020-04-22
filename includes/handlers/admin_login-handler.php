<?php 
if (isset($_POST['adminlogin'])) {
	//login button is pressed
	
	$adminMail = $_POST['adminMail'];
	$adminpasword = $_POST['adminPassword'];

	// Login functionin
	$result = $account->adminlogin($adminMail,$adminpasword);
	if ($result == true) {
		$_SESSION['adminLoggedIn'] = $adminMail;
		header("Location:admin_profile.php");
	}
}
 ?>