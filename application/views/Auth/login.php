<?php $this->load->view('Layout/header') ?>

<section class="login p-fixed d-flex text-center bg-primary">

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">

				<div class="login-card card-block auth-body">
					<form class="md-float-material" action="<?= base_url('Auth/cek_login'); ?>" method="POST">
						<!-- <div class="text-center">
							<img src="<?= base_url(); ?>vendor/assets/images/auth/logo.png" alt="logo.png">
						</div> -->
						<div class="auth-box">
							<div class="row m-b-20">
								<div class="col-md-12">
									<h3 class="text-left txt-primary"><?= $title; ?></h3>
								</div>
							</div>
							<hr>
							<!-- form input-->
							<?php $this->view('massag') ?>
							<div class="input-group">
								<input type="email" class="form-control " name="email" placeholder="Your Email Address">
								<span class="md-line"></span>
							</div>
							<div class="input-group">
								<input type="password" class="form-control" name="password" placeholder="Password">
								<span class="md-line"></span>
							</div>
							<div class="row m-t-25 text-left">
								<div class="col-sm-7 col-xs-12">
									<div class="checkbox-fade fade-in-primary">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
											<span class="text-inverse">Remember me</span>
										</label>
									</div>
								</div>
								<div class="col-sm-5 col-xs-12 forgot-phone text-right">
									<a href="forgot-password.html" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Login</button>
									<a href="<?= base_url('Auth/Register'); ?>" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Daftar</a>
								</div>
							</div>
							<!-- end form input -->
							<hr>
						</div>
					</form>

				</div>

			</div>

		</div>

	</div>

</section>
<?php $this->load->view('Layout/footer') ?>
</body>

</html>
