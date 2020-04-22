<?php 

class Account
{
	private $errorArrary;
	private $con;
	
	public function __construct($con) 
	{
		$this->con=$con;
		$this->errorArrary  = array();
	}

		public function register($userName,$userFirstName,$userLastName,$userUSN,$userMail,$userPhoneNumber,$userAddress,$userParentName,$userParentNumber,$userRoomNumber,$userPassword,$userConfirmPassword)
		{
			$this->validateUserName($userName);
			$this->validateFirstName($userFirstName);
			$this->validateLastName($userLastName);
			$this->validateString($userUSN);
			$this->validateEmail($userMail);
			$this->validateNumber($userPhoneNumber);
			$this->validateAddress($userAddress);
			$this->validateUserName($userParentName);
			$this->validateNumber($userParentNumber);
			$this->validateRoomNumber($userRoomNumber);
			$this->validatePassword($userPassword,$userConfirmPassword);

			if(empty($this->errorArrary)){
				// inset into data base
				return $this->insertUserDetails($userName,$userFirstName,$userLastName,$userUSN,$userMail,$userPhoneNumber,$userAddress,$userParentName,$userParentNumber,$userRoomNumber,$userPassword);
			}
			else {
				return false;
			}
		}

		public function orderfood($breakfastorderid,$lunchorderid,$snackorderid,$dinnerorderid,$userLoggedIn){
			$this->tochecktheid($breakfastorderid);
			$this->tochecktheid($lunchorderid);
			$this->tochecktheid($snackorderid);
			$this->tochecktheid($dinnerorderid);
			
			$sqlquery = mysqli_query($this->con , "SELECT id FROM students WHERE mail_id='$userLoggedIn'");
			if (mysqli_num_rows($sqlquery)>0) {
						$row = mysqli_fetch_assoc($sqlquery);
						$studentid = $row['id'];
			}
			$date =date("Y-m-d");
			if ($breakfastorderid!=0 && $lunchorderid !=0 && $snackorderid !=0 && $dinnerorderid !=0) {
					$sqlquery = mysqli_query($this->con , "SELECT studentid,date FROM food_order WHERE studentid='$studentid' AND date='$date';");
					if (mysqli_num_rows($sqlquery)>0) {
								echo "<script type='text/javascript'>
										swal({
												title:'Your Order is already Placed',
												icon:'warning'
											});
										</script>";
					}else {
					$result = mysqli_query($this->con , "INSERT INTO food_order VALUES ('','$studentid','$breakfastorderid','$lunchorderid','$snackorderid','$dinnerorderid','$date');");
				echo "<script type='text/javascript'>
				swal({
						title:'Order Placed',
						icon:'success'
					});
				</script>";
				return $result;
				}
				}
		}

		public function drop_down_menu($foodtable){
			$sqlquery = mysqli_query($this->con , "SELECT * FROM $foodtable;");
			if (mysqli_num_rows($sqlquery)>0) {
						while ($row = mysqli_fetch_assoc($sqlquery)) {
						$foodid = $row['id'];
						$food_name=$row['food'];
						echo "<option value='$foodid'>$food_name</option>\n";
					}
			}
		}
		private function tochecktheid ($na){
		if ($na==0) {
				array_push($this->errorArrary, Constants::$choice);
				return;
			}
		}

		public function adminregister($adminMail,$adminName,$adminPassword,$adminPassword2,$admindesignation,$adminPhoneNumber){
			$this->validateUserName($adminName);
			$this->validateAdminEmail($adminMail);
			$this->validatePassword($adminPassword,$adminPassword2);
			$this->validateUserName($admindesignation);
			$this->validateNumber($adminPhoneNumber);
			$admindesignation = strtolower($admindesignation);
			if(empty($this->errorArrary)){
				// inset into data base
				return $this->insertAdminDetails($adminMail,$adminName,$adminPassword,$admindesignation,$adminPhoneNumber);
			}
			else {
				return false;
			}
		}

		private function insertAdminDetails($adminMail,$adminName,$adminPassword,$admindesignation,$adminPhoneNumber)
		{
			$encryptedPw = md5($adminPassword);
			$date =date("Y-m-d H:i:s");
			// echo "INSERT INTO admin VALUES ('','$adminMail','$adminPhoneNumber','$encryptedPw','$admindesignation','$adminName','$date')";
			// exit();
			$result = mysqli_query($this->con , "INSERT INTO  admin (`id`, `mail_id`, `designation`, `password`, `phone_number`, `name`, `date`) VALUES ('','$adminMail','$admindesignation','$encryptedPw','$adminPhoneNumber','$adminName','$date')");
			echo "<script type='text/javascript'>
				swal({
						title:'New Admin Created',
						icon:'success'
					});
				</script>";
			return $result;
		}


		public function addingvisitor($studentName,$studentUSN,$visitorPhoneNumber,$visitorName)
		{
			$this->validateNumber($visitorPhoneNumber);
			$this->validateUserName($studentName);
			$this->validateUSN($studentUSN);
			$this->validateUserName($visitorPhoneNumber);

			
			if(empty($this->errorArrary)){
				// inset into data base
				$date =date("Y-m-d H:i:s");
				mysqli_query($this->con ,"INSERT INTO visitor VALUES ('','$studentName','$studentUSN','$visitorName','$visitorPhoneNumber','$date');");
						echo "<script type='text/javascript'>
									swal({
											title:'U Can Visit Now',
											icon:'success'
										});
									</script>";
			}
			else {
				return false;
			}

				
		}

		//login fuction
		public function login($em,$pw)
		{
			$pw = md5($pw);
			$date =date("Y-m-d H:i:s");
			$loginCheck = mysqli_query($this->con , "SELECT * FROM students WHERE mail_id='$em' AND password='$pw' ");
			if (mysqli_num_rows($loginCheck)) {
				$logindatetime = mysqli_query($this->con ,"UPDATE students SET date_of_login='$date'  WHERE mail_id='$em';");
				return true;
			}else{
				array_push($this->errorArrary, Constants::$loginFailed);
				return false;
			}
		}
		
		public function canteenlogin($em,$pw)
		{
			$pw = md5($pw);
			$loginCheck = mysqli_query($this->con , "SELECT * FROM canteenandgate WHERE mail_id='$em' AND password='$pw'AND typeofperson='canteen'");
			if (mysqli_num_rows($loginCheck)) {
				return true;
			}else{
				array_push($this->errorArrary, Constants::$loginFailed);
				return false;
			}
		}

		public function adminlogin($em,$pw)
		{
			$pw = md5($pw);
			$loginCheck = mysqli_query($this->con , "SELECT * FROM admin WHERE mail_id='$em' AND password='$pw'");
			if (mysqli_num_rows($loginCheck)) {
				return true;
			}else{
				array_push($this->errorArrary, Constants::$loginFailed);
				return false;
			}
		}

		
		public function getError($error){
			if (!in_array($error, $this->errorArrary)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($userName,$userFirstName,$userLastName,$userUSN,$userMail,$userPhoneNumber,$userAddress,$userParentName,$userParentNumber,$userRoomNumber,$userPassword)
		{
			$encryptedPw = md5($userPassword);
			$profilePic = "assets/images/profile-pic/download.png";
			$date =date("Y-m-d H:i:s");
			$userUSN = strtoupper($userUSN);
			$result = mysqli_query($this->con , "INSERT INTO students VALUES ('','$userMail','$userFirstName','$userLastName','$userName','$userUSN','$userPhoneNumber','$userAddress','$userParentName','$userParentNumber','$userRoomNumber','$encryptedPw','$date','$profilePic','')");
			echo "<script type='text/javascript'>
				swal({
						title:'New User Created',
						icon:'success'
					});
				</script>";
			return $result;
		}

		private function validateUserName($us)
		{
			if (strlen($us)>25||strlen($us)<5) {
				array_push($this->errorArrary, Constants::$userNameLength);
				return;
			}

		}

		private function validateFirstName($fn)
		{	
			if (strlen($fn)>25||strlen($fn)<2) {
				array_push($this->errorArrary,Constants::$firstNameLength );
				return;
			}
		}

		private function validateLastName($ln)
		{
			if (strlen($ln)>25||strlen($ln)<2) {
				array_push($this->errorArrary,Constants::$lastNameLength);
				return;
			}
		}

		private function validateEmail($email)
		{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArrary, Constants::$emailInvalid);
				return;
			}
			$checkEmailquery = mysqli_query($this->con , "SELECT mail_id FROM students WHERE mail_id='$email'");
			if (mysqli_num_rows( $checkEmailquery) != 0) {
				array_push($this->errorArrary, Constants::$mailExist);
				echo "<script type='text/javascript'>
										swal({
												title:'MAil ID already exist',
												icon:'warning'
											});
										</script>";
				return;
			}
		}	
		private function validateAdminEmail($email)
		{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArrary, Constants::$emailInvalid);
				return;
			}
			$checkEmailquery = mysqli_query($this->con , "SELECT mail_id FROM admin WHERE mail_id='$email'");
			if (mysqli_num_rows( $checkEmailquery) != 0) {
				array_push($this->errorArrary, Constants::$mailExist);
				echo "<script type='text/javascript'>
										swal({
												title:'MAil ID already exist',
												icon:'warning'
											});
										</script>";
				return;
			}
		}	

		private function validatePassword($ps,$ps2)
		{
			if ($ps != $ps2) {
				array_push($this->errorArrary, Constants::$passwordDoNotMAtch);
				return;
			}
			if (strlen($ps)>30||strlen($ps)<8) {
				array_push($this->errorArrary,Constants::$passwordLength);
				return;
			}
			//entered password is correct
		}

		private function validateString($us)
		{
			if (strlen($us)!= 10) {
				array_push($this->errorArrary,Constants::$USNLength);
				return;
			}
			if (mysqli_num_rows(mysqli_query($this->con , "SELECT usn FROM students WHERE usn='$us' ")) != 0) {
				array_push($this->errorArrary, Constants::$USNExist);
				echo "<script type='text/javascript'>
										swal({
												title:'USN already exist',
												icon:'warning'
											});
										</script>";
				return;
			}
			}

		private function validateNumber($pn)
		{
			if (strlen($pn)!=10) {
				array_push($this->errorArrary,Constants::$phoneNumberLength);
				return;
			}
			// phonne number is proper
		}
		private function validateAddress($ad)
		{
			if (strlen($ad)>500) {
				array_push($this->errorArrary,Constants::$addressLength);
				return;
			}
			if (preg_match('/^A-Za-z0-9#,./', $ad)) {
				array_push($this->errorArrary,Constants::$addressInvalid);
				return;
			}
			// address is proper
		}

		private function validateUSN($us){
			if (strlen($us)!= 10) {
				array_push($this->errorArrary,Constants::$USNLength);
				return;
			}
			if (mysqli_num_rows(mysqli_query($this->con , "SELECT usn FROM students WHERE usn='$us' ")) == 0) {
				array_push($this->errorArrary, Constants::$USNDOExist);
				echo "<script type='text/javascript'>
										swal({
												title:'USN do not exist',
												icon:'error',
												text:'The student USN is not present in the hosteldatabase please contact student'
											});
										</script>";
				return;
			}
		}

		private function validateRoomNumber($rn)
		{
			if ($rn>100||$rn<000) {
				array_push($this->errorArrary, Constants::$roomNumberInvalid);
				return;
			}
		}
}
 ?>