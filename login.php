<?php


	include("includes/config.php");
	include("includes/classes/Account.php");
	include('includes/classes/Constants.php');

	$account = new Account($con);

	include("includes/handlers/login-handler.php");

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
	<link rel="stylesheet" href="styling/styling_home.css">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|PT+Mono&display=swap" rel="stylesheet">
</head>
<body>
	<div class="mainbody">
	<div class="header">
		<h1>Hostel Database system</h1>
	</div>
	<div class="menu">
		<a href="admin_login.php" class="reference">Admin Login</a>
		<a href="login.php" class="reference">Student Login</a>
	</div>

	<div id="userLogin" class="login-box">
		<form id="loginForm" action="login.php"  method="post">
			<h2>Student Login</h2>

			<p>
				<?php echo $account->getError(Constants::$loginFailed); ?>
				<br>
				<!-- <label for="loginMail">Mail ID</label> -->
				<input type="email" name="loginMail" id="loginMail"  value="<?php getInputValue('userFirstName') ?>" placeholder="Mail ID" required="">
			</p>
			
			
			<p>
				<!-- <label for="loginPassword">Password</label> -->
				<input id="loginPassword" type="password" placeholder="Password" name="loginPassword"required="">
			</p>
			

			<button  type="submit" name="login">Login</button>
		</form>
	</div>
</div>
</body>
</html>
