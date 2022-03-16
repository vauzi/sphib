<?php $this->load->view('Layout/header') ?>
<?php $this->load->view('Layout/topbar') ?>
<?php $this->load->view('Layout/sidebar', $title) ?>
<div class="pcoded-content">
	<div class="pcoded-inner-content">

		<div class="main-body">
			<div class="page-wrapper">

				<div class="page-header">
					<div class="page-header-title">
						<h4><?= $title; ?> </h4>
					</div>
					<div class="page-header-breadcrumb">
						<ul class="breadcrumb-title">
							<li class="breadcrumb-item">
								<a href="index-2.html">
									<i class="icofont icofont-home"></i>
								</a>
							</li>
							<li class="breadcrumb-item">Pengolaan Data</a>
							</li>
							<li class="breadcrumb-item"><?= $title; ?></a>
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
									<?= form_open('Admin/Prediksi/hitungModal', ['class'=>'Hitung']); ?>
									<div class="form-grup row">
										<div class="col-sm-3">
											<label for="form-grup"><b>Luas Lahan</b></label>
											<select class="form-control" name="lahan" id="lahan">
												<option value="KECIL">KECIL</option>
												<option value="LUAS">Luas<LUAS/option>
											</select>
										</div>
										<div class="col-sm-3">
											<label for="form-grup"><b>Rasio Pupuk</b></label>
											<select class="form-control" name="rasio" id="rasio">
												<option value="RENDAH">Rendah</option>
												<option value="SEDANG">Sedang</option>
												<option value="TINGGI">tinggi</option>
											</select>
										</div>
										<div class="col-sm-3">
											<label for="form-grup"><b>Kualitas Air</b></label>
											<select class="form-control" name="air" id="air">
												<option value="HAMPIR SESUAI">Hampir Sesuai</option>
												<option value="CUKUP SESUAI">Cukup Sesuai</option>
												<option value="SANGAT SESUAI">Sangat Sesuai</option>
											</select>
										</div>
										
										<div class="col-sm-3">
											<label for="form-grup"><b>Tingkat Kelolosan Hidup</b></label>
											<select class="form-control" name="hidup" id="hidup">
												<option value="KURANG BAIK">Kurang Baik</option>
												<option value="BAIK">Baik</option>
											</select>
										</div>
									</div>
									<div class="mt-4" style="margin-left: 53rem;">
										<button type="submit" class="btn btn-success btnhitung">HItung Prediksi</button>
									</div>
									<?= form_close(); ?>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="viewModal" style="display: none;"></div>
<script>
	$(document).ready(function(e) {
		$('.Hitung').submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: "json",
				beforeSend: function() {
					$('.btnhitung').removeData('disable');
					$('.btnhitung').html('<i class = "fa fa-spin fa-spinner"></i>');
				},
				complete: function() {
					$('.btnhitung').removeAttr('disable');
					$('.btnhitung').html('Hitung Prediksi');
				},
				success: function(response) {
					console.log(response.modal)
					$('.viewModal').html(response.modal).show();
					$('#modalPrediksi').modal('show');
					$('#exampleModalLongTitle').html('Prediksi');
					$('.untung').html(response.untung);
					$('.rugi').html(response.rugi);
					$('.lahanuntung').html(response.lahan_untung);
					$('.rasiountung').html(response.rasio_untung);
					$('.airuntung').html(response.air_untung);
					$('.hidupuntung').html(response.hidup_untung);

					$('.lahanrugi').html(response.lahan_rugi);
					$('.rasiorugi').html(response.rasio_rugi);
					$('.airrugi').html(response.air_rugi);
					$('.hiduprugi').html(response.hidup_rugi);


					$('.hasilPYH').html(response.PYH);
					$('.hasilPXH').html(response.PXH);
					if (response.PY > response.PX) {
						$('.HasilPrediksi').html('UNTUNG');
					} else {
						$('.HasilPrediksi').html('RUGI');
					}

				},
				error: function(xhr, ajaxOption, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
		});
	})
</script>
<?php $this->load->view('Layout/footer') ?>