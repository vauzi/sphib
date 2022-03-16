<?php $this->load->view('Layout/header') ?>

<section class="login p-fixed d-flex text-center bg-primary">

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="login-card card-block auth-body">
					<?= form_open(base_url('Auth/Register'), ['class' => 'saveDataset']); ?>
					<div class="text-center">
						<!-- <img src="<?= base_url(); ?>vendor/assets/images/auth/logo.png" alt="logo.png"> -->
					</div>
					<div class="auth-box">
						<div class="row m-b-20">
							<div class="col-md-12">
								<h3 class="text-center txt-primary">Form Registrasi</h3>
							</div>
						</div>
						<!-- form input -->
						<div class="input-group">
							<input type="text" class="form-control <?= form_error('username') ? 'form-control-danger' : '' ?>" name="username" id="username" placeholder="Choose Username">
							<span class="md-line"></span>
						</div>
						<?php if (form_error('username')) : ?>
							<div class="text-danger">
								<?= form_error('username'); ?>
							</div>
						<?php endif; ?>
						<div class="input-group">
							<input type="emai" class="form-control <?= form_error('email') ? 'form-control-danger' : '' ?>" name="email" id="email" placeholder="Your Email Address">
							<span class="md-line"></span>
						</div>
						<?php if (form_error('email')) : ?>
							<div class="text-danger">
								<?= form_error('email'); ?>
							</div>
						<?php endif; ?>
						<div class="input-group">
							<input type="password" class="form-control <?= form_error('password') ? 'form-control-danger' : '' ?>" name="password" id="password" placeholder="Choose Password">
							<span class="md-line"></span>
						</div>
						<?php if (form_error('password')) : ?>
							<div class="text-danger">
								<?= form_error('password'); ?>
							</div>
						<?php endif; ?>
						<div class="input-group">
							<input type="password" class="form-control <?= form_error('passconf') ? 'form-control-danger' : '' ?>" name="passconf" id="passconf" placeholder="Confirm Password">
							<span class="md-line"></span>
						</div>
						<?php if (form_error('passconf')) : ?>
							<div class="text-danger">
								<?= form_error('passconf'); ?>
							</div>
						<?php endif; ?>
						<div class="row m-t-30">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Save</button>
							</div>
						</div>
						<!-- end Form -->
					</div>
					<?= form_close(); ?>

				</div>

			</div>

		</div>

	</div>

</section>

<?php $this->load->view('Layout/footer') ?>
</body>

</html>
