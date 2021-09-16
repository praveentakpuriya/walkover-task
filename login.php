<?php
include "database.php";
session_start();

?>
<?php require "config/header.php" ?>

<body>

  <?php require "config/nav.php" ?>
  <div class="container">
    <div class="row">
      <div class="col-md-5 mx-auto mt-5">
        <?php if (isset($_SESSION['created'])) : ?>
          <div class="alert alert-success">
            <?php echo $_SESSION['created']; ?>
          </div>
        <?php endif; ?>
        <?php unset($_SESSION['created']); ?>
        <div class="card">
          <div class="card-header">
            <h3>Login User</h3>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <div class="form-group">
                  <input type="email" id="email" class="form-control email" placeholder="Email">
                  <div class="invalid-feedback emailError" style="font-size:16px;">Email is required</div>
                </div>
                <!-- Close form-group -->
                <div class="form-group">
                  <input type="password" id="password" class="form-control password" placeholder="Password">
                  <div class="invalid-feedback passwordError" style="font-size:16px;">Password is required</div>
                </div>
                <!-- Close form-group -->
                <div class="form-group">
                  <button type="button" id="login" class="btn btn-info">Login &rarr;</button>
                  <a href="registration.php" style="float:right;margin-top:10px;">Create new account</a>
                </div>
                <!-- Close form-group -->
            </form>
          </div>
          <!-- Close card-body -->
        </div>
        <!-- Close card -->
      </div>
      <!-- Close col-md-5 -->
    </div>
    <!-- Close row -->
  </div>
  <!-- Close container -->

	<?php require "config/footer.php" ?>