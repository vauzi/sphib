<div class="pcoded-main-container">
	<div class="pcoded-wrapper">
		<nav class="pcoded-navbar" pcoded-header-position="relative">
			<div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
			<div class="pcoded-inner-navbar main-menu">
				<div class="">
					<div class="main-menu-header">
						<img class="img-40" src="<?= base_url() ?>vendor/assets/images/user.png" alt="User-Profile-Image">
						<div class="user-details">
							<span><?= $this->session->userdata('username'); ?></span>
							<span id="more-details"><?= $this->session->userdata('user_level') == 1 ? 'ADMIN' : 'MEMBER' ?><i class="ti-angle-down"></i></span>
						</div>
					</div>
					<div class="main-menu-content">
						<ul>
							<li class="more-details">
								<a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
								<a href="#!"><i class="ti-settings"></i>Settings</a>
								<a href="<?= base_url('Auth/logout'); ?>"><i class="ti-layout-sidebar-left"></i>Logout</a>
							</li>
						</ul>
					</div>
				</div>
				<?php if ($this->session->userdata('user_level') == 1) : ?>
					<div class="pcoded-navigatio-lavel" data-i18n="nav.category.support" menu-title-theme="theme5">Halaman Utama</div>
					<ul class="pcoded-item pcoded-left-item">
						<li class="<?= $title == 'Dashboard' ? 'active' : ''; ?> ">
							<a href="<?= base_url('Admin/Dashboard'); ?>" data-i18n="nav.widget.main">
								<span class="pcoded-micon"><i class="ti-view-grid"></i></span>
								<span class="pcoded-mtext">Dashboard</span>
								<span class="pcoded-mcaret"></span>
							</a>
						</li>
					</ul>
					<div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">Manage Data</div>
					<ul class="pcoded-item pcoded-left-item">
						<li class=" ">
							<a href="<?= base_url('Admin/User'); ?>" data-i18n="nav.widget.main">
								<span class="pcoded-micon <?= $title == 'Data User' ? 'active' : ''; ?>"><i class="ti-layout-sidebar-left"></i></span>
								<span class="pcoded-mtext">Data User</span>
								<span class="pcoded-mcaret"></span>
							</a>
						</li>
					</ul>
					<ul class="pcoded-item pcoded-left-item">
						<li class="pcoded-hasmenu 
						<?php if ($title == 'Dataset') {
							echo 'active';
						} elseif ($title == 'Prediksi') {
							echo 'active';
						} else {
							echo '';
						} ?>">
							<a href="javascript:void(0)">
								<span class="pcoded-micon"><i class="ti-home"></i></span>
								<span class="pcoded-mtext" data-i18n="nav.dash.main">Pengolaan Data</span>
								<span class="pcoded-mcaret"></span>
							</a>
							<ul class="pcoded-submenu">
								<li class="">
									<a href="<?= base_url('User/Dataset'); ?>">
										<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
										<span class="pcoded-mtext" data-i18n="nav.dash.default">Dataset</span>
										<span class="pcoded-mcaret"></span>
									</a>
								</li>
								<li class=" ">
									<a href="<?= base_url('Admin/Prediksi'); ?>">
										<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
										<span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Prediksi</span>
										<span class="pcoded-mcaret"></span>
									</a>
								</li>
								<li class=" ">
									<a href="<?= base_url('User/Prediksi'); ?>">
										<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
										<span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Data Prediksi</span>
										<span class="pcoded-mcaret"></span>
									</a>
								</li>
							</ul>

						</li>
					</ul>
				<?php endif ?>
				<?php if ($this->session->userdata('user_level') == 2) : ?>
					<div class="pcoded-navigatio-lavel" data-i18n="nav.category.support" menu-title-theme="theme5">Halaman Utama</div>
					<ul class="pcoded-item pcoded-left-item">
						<li class="<?= $title == 'Dashboard' ? 'active' : ''; ?> ">
							<a href="<?= base_url('Admin/Dashboard'); ?>" data-i18n="nav.widget.main">
								<span class="pcoded-micon"><i class="ti-view-grid"></i></span>
								<span class="pcoded-mtext">Dashboard</span>
								<span class="pcoded-mcaret"></span>
							</a>
						</li>
					</ul>
					<div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">Manage Data</div>
					<ul class="pcoded-item pcoded-left-item">
						<li class="pcoded-hasmenu 
						<?php if ($title == 'Dataset') {
							echo 'active';
						} elseif ($title == 'Prediksi') {
							echo 'active';
						} else {
							echo '';
						} ?>
						">
							<a href="javascript:void(0)">
								<span class="pcoded-micon"><i class="ti-home"></i></span>
								<span class="pcoded-mtext" data-i18n="nav.dash.main">Pengolaan Data</span>
								<span class="pcoded-mcaret"></span>
							</a>
							<ul class="pcoded-submenu">
								<li class="">
									<a href="<?= base_url('User/Dataset'); ?>">
										<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
										<span class="pcoded-mtext" data-i18n="nav.dash.default">Dataset</span>
										<span class="pcoded-mcaret"></span>
									</a>
								</li>
								<li class=" ">
									<a href="<?= base_url('User/Prediksi'); ?>">
										<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
										<span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Prediksi</span>
										<span class="pcoded-mcaret"></span>
									</a>
								</li>
								<li class=" ">
									<a href="<?= base_url('User/Prediksi'); ?>">
										<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
										<span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Data Prediksi</span>
										<span class="pcoded-mcaret"></span>
									</a>
								</li>
							</ul>

						</li>
					</ul>
				<?php endif; ?>

				<div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5"></div>
				<ul class="pcoded-item pcoded-left-item">
					<li class=" ">
						<a href="<?= base_url('Auth/logout'); ?>" data-i18n="nav.widget.main">
							<span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i></span>
							<span class="pcoded-mtext">Logout</span>
							<span class="pcoded-mcaret"></span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
