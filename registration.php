<?php

$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include 'partials/database.php';

	$username = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$exists = false;
	$exists_mysql = "select * from registration where email='$email'";
	$result = mysqli_query($con, $exists_mysql);
	$numOfRows = mysqli_num_rows($result);

	if ($numOfRows > 0) {
		$showError="User already exists";
	} else {
		if (($password == $cpassword)) {
			$sql = "INSERT INTO `registration` ( `name`, `email`, `password`) VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($con, $sql);
			if ($result) {
				$showAlert = true;
			}
			header("location:login.php");
		} else {
			$showError = "Password doesn't match";
		}
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<link href="style.css" rel="stylesheet" type="text/css" media="all" />

	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
	<!-- //web font -->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
	<?php require "partials/nav.php" ?>
	<!-- main -->

	<?php
	if ($showAlert) {
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Success!</strong> You are reistered
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
	}

	if ($showError) {
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Error!</strong> ' . $showError . '
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
	}


	?>
	<div class="main-w3layouts wrapper container"></div>
	<h1>User Registration</h1>
	<div class="main-agileinfo">
		<div class="agileits-top">
			<form action="/WALKOVER-TASK/registration.php" method="post">
				<input class="text" type="text" name="name" placeholder="Full Name" required="">
				<input class="text email" type="email" name="email" placeholder="Email" required="">
				<input class="text" type="password" name="password" placeholder="Password" required="">
				<input class="text w3lpass" type="password" name="cpassword" placeholder="Confirm Password" required="">
				<div class="wthree-text">
					<label class="anim">
						<input type="checkbox" class="checkbox" required="">
						<span>I Agree To The Terms & Conditions</span>
					</label>
					<div class="clear"> </div>
				</div>
				<input type="submit" value="SIGNUP">
			</form>
			<p>Don't have an Account? <a href="#"> Login Now!</a></p>
		</div>
	</div>

	<ul class="colorlib-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
	</div>
	<!-- //main -->
</body>

</html>