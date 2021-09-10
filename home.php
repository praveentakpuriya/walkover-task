<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {

    header("location:login.php");
    exit;   // exit from the php script
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Welcome <?php echo $_SESSION['username'] ?></title>
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
 <div class="container mr-3 mr-md-3">
 <div class="card border-success mb-3 my-3 " style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Welcome</div>
        <div class="card-body text-success">
            <h5 class="card-title"><?php echo $_SESSION['username'] ?></h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores, eius sequi. Quos necessitatibus ullam enim, esse corrupti error odit quibusdam cupiditate delectus nam, dicta dolorum! Tempora itaque maxime doloremque molestias..</p>
        </div>
        <div class="card-footer bg-transparent border-success">Footer</div>
    </div>
 </div>
    
</body>

</html>