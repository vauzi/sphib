<?php $this->load->view('Layout/header') ?>
<?php $this->load->view('Layout/topbar') ?>
<?php $this->load->view('Layout/sidebar', $title) ?>


<div class="pcoded-content">
	<div class="pcoded-inner-content">

		<div class="main-body">
			<div class="page-wrapper">

				<div class="page-header">
					<div class="page-header-title">
						<h4><?= $title; ?></h4>
					</div>
					<div class="page-header-breadcrumb">
						<ul class="breadcrumb-title">
							<li class="breadcrumb-item">
								<a href="index-2.html">
									<i class="icofont icofont-home"></i>
								</a>
							</li>
							<li class="breadcrumb-item"><a href="#!">Page Layouts</a>
							</li>
							<li class="breadcrumb-item"><a href="#!">Vertical</a>
							</li>
							<li class="breadcrumb-item"><a href="#!">Static Layout</a>
							</li>
						</ul>
					</div>
				</div>


				<div class="page-body">
					<div class="row">
						<div class="col-lg-12">

							<div class="card">
								<div class="card-header">
									<h5><?= $title; ?></h5>
								</div>
								<div class="card-block">
									<b class="text-center">
										<h2>Selamat datang<strong> <?= $user['username']; ?></strong></h2>
										<p>Selamat datang di Sistem Prediksi Hasil Panen Ikan Bandeng</p>
									</b>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>

		<div id="styleSelector">
		</div>
	</div>
</div>

<?php $this->load->view('Layout/footer') ?>

</body>

</html>
