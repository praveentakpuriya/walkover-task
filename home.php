<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {

    header("location:login.php");
    exit;
      
}else if((isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) && $_SESSION['role']==1 ){
    header("location:adminDashboard.php");
    exit;
    
}

?>
<?php require "config/header.php" ?>
<body>
    <?php require "config/nav.php" ?>
 <div class="container mr-3 mr-md-3">
 <div class="card border-success mb-3 my-3 " style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Welcome <?php echo $_SESSION['username'] ?></div>
        <div class="card-body text-success">
            <h5 class="card-title">Hello !</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores, eius sequi. Quos necessitatibus ullam enim, esse corrupti error odit quibusdam cupiditate delectus nam, dicta dolorum! Tempora itaque maxime doloremque molestias..</p>
        </div>
        <div class="card-footer bg-transparent border-success">Footer</div>
    </div>
 </div>

 <?php
 require "config/footer.php" ?>