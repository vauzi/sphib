<nav class="navbar header-navbar pcoded-header" header-theme="theme4">
	<div class="navbar-wrapper">
		<div class="navbar-logo">
			<a class="mobile-menu" id="mobile-collapse" href="#!">
				<i class="ti-menu"></i>
			</a>
			<a href="index-2.html">
				<b>
					<h3>Sistem Prediksi</h3>
				</b>
			</a>
			<a class="mobile-options">
				<i class="ti-more"></i>
			</a>
		</div>
		<div class="navbar-container container-fluid">
			<div>
				<ul class="nav-left">
					<li>
						<div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
					</li>
					<li>
						<a href="#!" onclick="javascript:toggleFullScreen()">
							<i class="ti-fullscreen"></i>
						</a>
					</li>

				</ul>

				<ul class="nav-right">
					<li class="user-profile header-notification">
						<a href="#!">
							<img src="<?= base_url(); ?>vendor/assets/images/user.png" alt="User-Profile-Image">
							<span>
								<?php
								$email = $this->session->userdata('email');
								$user = $this->db->get_where('user', ['email' => $email])->row_arraY();
								echo $user['username'];
								?></span>
							<i class="ti-angle-down"></i>
						</a>
						<ul class="show-notification profile-notification">
							<li>
								<a href="auth-lock-screen.html">
									<i class="ti-lock"></i> Lock Screen
								</a>
							</li>
							<li>
								<a href="<?= base_url('Auth/logout'); ?>">
									<i class="ti-layout-sidebar-left"></i> Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
