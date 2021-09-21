<?php require "config/header.php" ?>

<body>

	<?php require "config/nav.php" ?>

	<div class="container">
		<div class="row">
			<div class="col-md-5 mx-auto mt-5">
				<div class="card">
					<div class="card-header">
						<h3>Signup User</h3>
					</div>
					<div class="card-body">
						<form>
							<div class="form-group">
								<input type="text" id="name" class="form-control name" placeholder="Name" autocomplete="off">
								<div class="invalid-feedback nameerror" style="font-size:16px;">Name not be NUll</div>
								<!-- <h5 id="namecheck"></h5> -->
							</div>
							<!-- Close form-group -->
							<div class="form-group">
								<input type="email" id="email" class="form-control email" placeholder="Email" autocomplete="off">
								<div class="invalid-feedback emailError" style="font-size:16px;"></div>
							
							</div>
							<!-- Close form-group -->
							<div class="form-group">
								<input type="password" id="password" class="form-control password" placeholder="Password" autocomplete="off">
								<div class="invalid-feedback passerror" style="font-size:16px;"></div>
								<!-- <h5 id="passwordcheck"></h5> -->
							</div>

							<div class="form-group">
								<input type="password" id="cpassword" class="form-control cpassword" placeholder="Confirm Password" autocomplete="off">
								<div class="invalid-feedback cpaserror" style="font-size:16px;"></div>
								<!-- <h5 id="cpasswordcheck"></h5> -->
							</div>
							<div class="form-group">
								<textarea name="desc" id="desc" cols="30" placeholder="decription" rows="5"></textarea>
							</div>

							<!-- Close form-group -->
							<div class="form-group">
								<button type="button" id="signup" class="btn btn-info">Signup &rarr;</button>
								<a href="login.php" style="float:right;margin-top:10px;">Already have an account ?</a>
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