<?php


	include("includes/config.php");


	 // session_destroy();
	if (isset($_SESSION['adminLoggedIn'])) {
	$adminLoggedIn = $_SESSION['adminLoggedIn'];
	}else{
		header("Location:admin_login.php");
	}

if (isset($_POST['breakfastdeletefood'])) {
    $foodid= $_POST['breakfastdeletefood'];
    mysqli_query($con,"DELETE FROM breakfast WHERE id='$foodid';");
}


if (isset($_POST['breakFastButton'])) {
    $breakFastitem = $_POST['breakFastitem'];
    $breakFastvalue = strtolower($breakFastitem);
    $breakFastvalue = str_replace(" ", "", $breakFastvalue);
    mysqli_query($con,"INSERT INTO breakfast VALUES ('','$breakFastitem','$breakFastvalue')");
}

//lunch
if (isset($_POST['lunchdeletefood'])) {
    $foodid= $_POST['lunchdeletefood'];
    mysqli_query($con,"DELETE FROM lunch WHERE id='$foodid';");
}


if (isset($_POST['lunchButton'])) {
    $lunchitem = $_POST['lunchitem'];
    $lunchvalue = strtolower($lunchitem);
    $lunchvalue = str_replace(" ", "", $lunchvalue);
    mysqli_query($con,"INSERT INTO lunch VALUES ('','$lunchitem','$lunchvalue')");
}

//snackes
if (isset($_POST['snacksdeletefood'])) {
    $foodid= $_POST['snacksdeletefood'];
    mysqli_query($con,"DELETE FROM snacks WHERE id='$foodid';");
}


if (isset($_POST['snacksButton'])) {
    $snacksitem = $_POST['snacksitem'];
    $snacksvalue = strtolower($snacksitem);
    $snacksvalue = str_replace(" ", "", $snacksvalue);
    mysqli_query($con,"INSERT INTO snacks VALUES ('','$snacksitem','$snacksvalue')");
}
//dinner
if (isset($_POST['dinnerdeletefood'])) {
    $foodid= $_POST['dinnerdeletefood'];
    mysqli_query($con,"DELETE FROM dinner WHERE id='$foodid';");
}


if (isset($_POST['dinnerButton'])) {
    $dinneritem = $_POST['dinneritem'];
    $dinnervalue = strtolower($dinneritem);
    $dinnervalue = str_replace(" ", "", $dinnervalue);
    mysqli_query($con,"INSERT INTO dinner VALUES ('','$dinneritem','$dinnervalue')");
}
?>

<style type="text/css">
    input{
        border: none;
        border-bottom: 2px solid;
        text-align: center;

    }
    .container{

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
 	<title>Hostel Database</title>
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

<form id='addfoodmenuForm' action='adding_food_menu.php'  method='post' >
 <!-- breakfast  -->
<?php
echo "<div class='card' style='text-align: center;
                                border: 2px solid;
 								border-radius: 12px;'>
     <div class='container' style='width: auto;'>
     <h2>BreakFast</h2>
      <input type='text' name='breakFastitem' >
      <button  type='submit' name='breakFastButton'>Add</button><br><br>";
      $sqlquery = mysqli_query($con , "SELECT * FROM breakfast;");
      if (mysqli_num_rows($sqlquery)>0) {
            while ($row = mysqli_fetch_assoc($sqlquery)) {
            $foodid = $row['id'];
            $food_name=$row['food'];
            $food_value=$row['values'];
            echo "<div style='text-align:right;'>
            $food_name <button  type='submit' value='$foodid' name='breakfastdeletefood'>Delete</button><br><br>
            </div>";
          }
      }
      echo "</div>
            </div>";
 ?>
</form>
<form id='addfoodmenuForm' action='adding_food_menu.php'  method='post' >
<!-- lunch -->
<?php
echo "<div class='card' style='text-align: center;
                               border: 2px solid;
 							    border-radius: 12px;'>
     <div class='container' style='width: auto;'>
     <h2>Lunch</h2>
      <input type='text' name='lunchitem' required=''>
      <button  type='submit' name='lunchButton'>Add</button><br><br>";
      $sqlquery = mysqli_query($con , "SELECT * FROM lunch;");
      if (mysqli_num_rows($sqlquery)>0) {
            while ($row = mysqli_fetch_assoc($sqlquery)) {
            $foodid = $row['id'];
            $food_name=$row['food'];
            $food_value=$row['values'];
            echo "<div style='text-align:right;'>
            $food_name <button  type='submit' value='$foodid' name='lunchdeletefood'>Delete</button><br><br>
            </div>";
          }
      }
      echo "</div>
            </div>";
 ?>
</form>
<!-- snacks -->
<form id='addfoodmenuForm' action='adding_food_menu.php'  method='post' >
 <?php
echo "<div class='card' style='text-align: center;
border: 2px solid;
 															 border-radius: 12px;'>
     <div class='container' style='width: auto;'>
     <h2>Snacks</h2>
      <input type='text' name='snacksitem' required=''>
      <button  type='submit' name='snacksButton'>Add</button><br><br>";
      $sqlquery = mysqli_query($con , "SELECT * FROM snacks;");
      if (mysqli_num_rows($sqlquery)>0) {
            while ($row = mysqli_fetch_assoc($sqlquery)) {
            $foodid = $row['id'];
            $food_name=$row['food'];
            $food_value=$row['values'];
            echo "<div style='text-align:right;'>
            $food_name <button  type='submit' value='$foodid' name='snacksdeletefood'>Delete</button><br><br>
            </div>";
          }
      }
      echo "</div>
            </div>";
 ?>
</form>
<!-- dinner -->
<form id='addfoodmenuForm' action='adding_food_menu.php'  method='post' >
 <?php
echo "<div class='card' style='text-align: center;border: 2px solid;
 															 border-radius: 12px;'>
     <div class='container' style='width: auto;'>
     <h2>Dinner</h2>
      <input type='text' name='dinneritem' required=''>
      <button  type='submit' name='dinnerButton'>Add</button><br><br>";
      $sqlquery = mysqli_query($con , "SELECT * FROM dinner;");
      if (mysqli_num_rows($sqlquery)>0) {
            while ($row = mysqli_fetch_assoc($sqlquery)) {
            $foodid = $row['id'];
            $food_name=$row['food'];
            $food_value=$row['values'];
            echo "<div style='text-align:right;'>
            $food_name <button  type='submit' value='$foodid' name='dinnerdeletefood'>Delete</button><br><br>
            </div>";
          }
      }
      echo "</div>
            </div>";
 ?>

 </form>
 </body>
 </html>
