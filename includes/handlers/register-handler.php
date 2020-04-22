<?php 


function sanitizeString($inputText)
{
	$inputText = strip_tags($inputText);
	return $inputText;
}
function sanitizeUserName($inputText)
{
	$inputText = strip_tags($inputText);
	$inputText = ucfirst(strtolower($inputText));
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

if (isset($_POST['siginup'])) {
	// siginup button is pressed
	$userName = sanitizeString($_POST['userName']);
	$userFirstName = sanitizeUserName($_POST['userFirstName']);
	$userLastName = sanitizeUserName($_POST['userLastName']);
	$userUSN= sanitizeString($_POST['userUSN']);
	$userMail = sanitizeString($_POST['userMail']);
	$userPhoneNumber = sanitizeString($_POST['userPhoneNumber']);
	$userAddress = sanitizeString($_POST['userAddress']);
	$userParentName = sanitizeString($_POST['userParentName']);
	$userParentNumber = sanitizeString($_POST['userParentNumber']);
	$userRoomNumber = sanitizeString($_POST['userRoomNumber']);
	$userPassword = sanitizeString($_POST['userPassword']);
	$userConfirmPassword = sanitizeString($_POST['userConfirmPassword']);
	
	$wasSuccessfull=$account->register($userName,$userFirstName,$userLastName,$userUSN,$userMail,$userPhoneNumber,$userAddress,$userParentName,$userParentNumber,$userRoomNumber,$userPassword,$userConfirmPassword);
	if ($wasSuccessfull == true) {
		
		}
}
 ?>