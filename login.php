<?php

$showAlert = false;
$showError = false;
$login = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/database.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "select * from registration where email='$email' AND password='$password'";

    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    $name = "select name from registration where email='$email' AND password='$password'";
    if ($num == 1) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
       // $_SESSION['username'] = $email;
        $_SESSION['username'] = $name;
        header("location:home.php");
    } else {
        $showError = "Wrong credentials";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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
    if ($login) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Success!</strong> You are Log In
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
    <h1>User Login</h1>
    <div class="main-agileinfo">
        <div class="agileits-top">
            <form action="/WALKOVER-TASK/login.php" method="post">
                <input class="text email" type="email" name="email" placeholder="Email" required="">
                <input class="text" type="password" name="password" placeholder="Password" required="">

                <input type="submit" value="Login">
            </form>
            <p>Don't have an Account? <a href="registration.php"> SignUp Now!</a></p>
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