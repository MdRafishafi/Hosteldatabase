<?php 
function sanitizeString($inputText)
{
	$inputText = strip_tags($inputText);
	return $inputText;
}

if (isset($_POST['adminsiginup'])) {
	// siginup button is pressed
	$adminName = sanitizeString($_POST['adminName']);
	$adminMail = sanitizeString($_POST['adminMail']);
	$admindesignation = sanitizeString($_POST['adminDesignation']);
	$adminPhoneNumber = sanitizeString($_POST['adminPhoneNumber']);
	$adminPassword = sanitizeString($_POST['adminPassword']);
	$adminPassword2 = sanitizeString($_POST['adminConfirmPassword']);
	
	$wasSuccessfull=$account->adminregister($adminMail,$adminName,$adminPassword,$adminPassword2,$admindesignation,$adminPhoneNumber);
	if ($wasSuccessfull == true) {
			
		}
}
 ?>