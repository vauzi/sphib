<?php $this->load->view('Layout/header') ?>
<?php $this->load->view('Layout/topbar') ?>
<?php $this->load->view('Layout/sidebar', $title) ?>

<?php
// konfigurasi database
$host       =   "localhost";
$username       =   "root";
$password   =   "";
$database   =   "ci_naivebayes";
// perintah php untuk akses ke database
$koneksi = mysqli_connect($host, $username, $password, $database);


$untung = $this->db->query("SELECT * FROM dataset WHERE class = 'UNTUNG'")->num_rows();
$rugi = $this->db->query("SELECT * FROM dataset WHERE class = 'RUGI'")->num_rows();
$i = 1;

?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">

				<div class="page-header">
					<div class="page-header-title">
						<h4> <?= $title; ?></h4>
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

							<button class="btn btn-info mb-3 tambahPrediksi"><i class="fa fa-plus-square"></i>Tambah
								Prediksi</button>
							<?php foreach ($prediksi as $p) : ?>

								<div class="card">
									<div class="card-header">
										<h5 class="card-header-text">Data Prediksi ON Precessing</h5>
									</div>
									<div class="card-block accordion-block color-accordion-block">
										<div class="color-accordion ui-accordion ui-widget ui-helper-reset">
											<a class="accordion-msg bg-primary b-none ui-accordion-header ui-corner-top ui-state-default ui-accordion-header-active ui-state-active ui-accordion-icons scale_active"><span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-up"></span>Tabel
												Kriteria Prediksi</a>
											<div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content ui-accordion-content-active">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th scope="col">Luas Lahan</th>
															<th scope="col">Jumlah bibit</th>
															<th scope="col">Pupuk Organik</th>
															<th scope="col">Pupuk Anorganik</th>
															<th scope="col">Rasio Pupuk</th>
															<th scope="col">Kualitas Air</th>
															<th scope="col">Tingkat Kehidupan</th>
															<th scope="col">Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$id_prediksi = $p['id_prediksi'];
														if ($p['lahan_prediksi'] >= 6000) {
															$kategoriLahan = 'LUAS';
														} elseif ($p['lahan_prediksi'] >= 1500) {
															$kategoriLahan = 'SEDANG';
														} else {
															$kategoriLahan = 'KECIL';
														}

														//tampil pada tabel pupuk
														$sumPupuk_organik = $this->db->query("SELECT SUM(berat_pupuk) FROM pupuk WHERE nama_pupuk = 'organik' AND id_prediksi = '$id_prediksi'")->row();
														$sumPupuk_anorganik = $this->db->query("SELECT SUM(berat_pupuk) FROM pupuk WHERE nama_pupuk = 'anorganik' AND id_prediksi = '$id_prediksi'")->row();
														foreach ($sumPupuk_organik as $organik) {
														}
														foreach ($sumPupuk_anorganik as $anorganik) {
														}
														//rasio
														//rasio pupuk
														$jumlahPupuk = $organik + $anorganik;
														$bobotOrganik =  $organik / $jumlahPupuk;
														$bobotAnorganik =  $anorganik / $jumlahPupuk;
														$persentasePupuk = $bobotAnorganik / $bobotOrganik;
														if ($persentasePupuk >= 1.6) {
															$rasioPupuk = "TINGGI";
														} elseif ($persentasePupuk >= 1.3) {
															$rasioPupuk = "SEDANG";
														} else {
															$rasioPupuk = "RENDAH";
														}
														//end


														//tampil tabel kualitas air
														$sum_air = $this->db->query("SELECT SUM(kualitas) FROM air WHERE id_prediksi = '$id_prediksi'")->row();
														foreach ($sum_air as $jmlair) {
														}
														$count_air = $this->db->query("SELECT * FROM air WHERE id_prediksi = '$id_prediksi'")->num_rows();
														$air = $jmlair / $count_air;
														//kategori Air
														if ($air > 80) {
															$kategoriAir = "SANGAT SESUAI";
														} elseif ($air > 65) {
															$kategoriAir = "CUKUP SESUAI";
														} else {
															$kategoriAir = "HAMPIR SESUAI";
														}
														//end air


														//tampil tabel tinggkat kehidupan
														$sumIkanMati = $this->db->query("SELECT SUM(jumlah_ikanmati) FROM ikanmati WHERE id_prediksi = '$id_prediksi'")->row();
														foreach ($sumIkanMati as $tingkatHidup) {
														}


														$jumlah_perekor = $p['bibit_prediksi'] - $tingkatHidup;
														$hidup = $jumlah_perekor / $p['bibit_prediksi'] * 100;
														if ($hidup < 26) {
															$kategori_hidup = 'KURANG BAIK';
														} else {
															$kategori_hidup = 'BAIK';
														}
														?>
														<tr>
															<td><?= $p['lahan_prediksi']; ?></td>
															<td><?= $p['bibit_prediksi']; ?></td>
															<td><?= $organik; ?> Kg</td>
															<td><?= $anorganik; ?> Kg</td>
															<td><?= $persentasePupuk; ?></td>
															<td><?= $air; ?> %</td>
															<td><?= $kategori_hidup ?> /<?= $hidup; ?> %</td>
															<td>
																<?= form_open('User/Prediksi/hitungprediksi', ['class' => 'hitungPrediksi']) ?>
																<input type="hidden" name="lahan" id="lahan" value="<?= $kategoriLahan; ?>">
																<input type="hidden" name="rasio" id="rasio" value="<?= $rasioPupuk; ?>">
																<input type="hidden" name="air" id="air" value="<?= $kategoriAir; ?>">
																<input type="hidden" name="hidup" id="hidup" value="<?= $kategori_hidup; ?>">
																<button type="submit" class="btn btn-primary btn-sm btnhitung">Hitung
																	Prediksi</button>
																<?= form_close(); ?>
															</td>
														</tr>
													</tbody>
												</table>
												<div class="prediksi">
													<h3>hasil Prediksi = UNTUNG</h3>
												</div>
											</div>
											<a class="accordion-msg bg-dark-primary b-none ui-accordion-header ui-corner-top ui-accordion-header-collapsed ui-corner-all ui-state-default ui-accordion-icons scale_active"><span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-down"></span>Tabel
												Pemberian Pupuk Pupuk</a>
											<div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content">
												<div class="row">
													<div class="col-lg-4">
														<button type="button" data-id="<?= $id_prediksi; ?>" class="btn btn-info mb-2 btnpupuk">Tambah Pupuk</button>
														<table class="table table-bordered">
															<thead>
																<tr class="bg-info">
																	<th scope="col">No</th>
																	<th scope="col">Tanggal</th>
																	<th scope="col">Jenis Pupuk</th>
																	<th scope="col">Berat Pupuk</th>
																	<th scope="col">Action</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$tb_pupuk = $this->db->get_where('pupuk', ['id_prediksi' => $id_prediksi])->result_array();
																$p1 = 1;
																foreach ($tb_pupuk as $tp) :
																?>
																	<tr>
																		<td><?= $p1++; ?></td>
																		<td><?= $tp['tanggal_pupuk']; ?></td>
																		<td><?= $tp['nama_pupuk']; ?></td>
																		<td><?= $tp['berat_pupuk']; ?></td>
																		<td>
																			<button type="button" data-id="<?= $tp['id_pupuk']; ?>" class="btn btn-danger btnhapuspupuk">Hapus</button>
																		</td>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<a class="accordion-msg bg-darkest-primary b-none ui-accordion-header ui-corner-top ui-accordion-header-collapsed ui-corner-all ui-state-default ui-accordion-icons scale_active">Tabel
												Laporan Air</a>
											<div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content">
												<div class="row">
													<div class="col-lg-4">
														<button type="button" data-id="<?= $id_prediksi ?>" class="btn btn-info mb-2 modalLaporanAir">Tambah Laporan
															Air</button>
														<table class="table table-bordered">
															<thead>
																<tr class="bg-success">
																	<th scope="col">No</th>
																	<th scope="col">Tanggal</th>
																	<th scope="col">Kualitas Air</th>
																	<th scope="col">Action</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$tb_air = $this->db->get_where('air', ['id_prediksi' => $id_prediksi])->result_array();
																foreach ($tb_air as $ta) :
																?>
																	<tr>
																		<td><?= $i++; ?></td>
																		<td><?= $ta['tanggal']; ?></td>
																		<td><?= $ta['kualitas']; ?></td>
																		<td>
																			<button type="button" class="btn btn-danger hapusAir" data-id="<?= $ta['id_air']; ?>">Hapus</button>
																		</td>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>

											</div>
											<a class="accordion-msg bg-darkest-primary b-none ui-accordion-header ui-corner-top ui-accordion-header-collapsed ui-corner-all ui-state-default ui-accordion-icons scale_active"><span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-down"></span>Tabel
												angka kematian pada ikan</a>
											<div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content">
												<b>Angka Kematian Pada Ikan</b>
												<div class="row mt-2">
													<div class="col-lg-4">
														<button type="button" data-id="<?= $id_prediksi; ?>" class="btn btn-info mb-2 ikanmati">Tambah laporan kematian
															Ikan</button>
														<table class="table table-bordered">
															<thead>
																<tr class="bg-success">
																	<th scope="col">No</th>
																	<th scope="col">Tanggal</th>
																	<th scope="col">Jumlah Ikan Yang Mati</th>
																	<th scope="col">Action</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$tb_ikanmati = $this->db->get_where('ikanmati', ['id_prediksi' => $id_prediksi])->result_array();
																$m = 1;
																foreach ($tb_ikanmati as $ti) :
																?>
																	<tr>
																		<td><?= $m++; ?></td>
																		<td><?= $ti['tanggal_mati']; ?></td>
																		<td><?= $ti['jumlah_ikanmati']; ?></td>
																		<td>
																			<button type="button" class="btn btn-primary hapusMati" data-id="<?= $ti['id_ikanmati']; ?>">Hapus</button>
																		</td>
																	</tr>
																<?php endforeach;  ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="viewModal" style="display: none;"></div>

			</div>
		</div>
	</div>
</div>
<div class="viewModal" style="display: none;"></div>
<script>
	$(document).ready(function(e) {
		$('.tambahPrediksi').click(function(e) {
			$.ajax({
				url: "<?= site_url('User/Prediksi/modal') ?>",
				dataType: "json",
				success: function(response) {
					if (response.modal) {
						$('.viewModal').html(response.modal).show();
						$('#modalPrediksi').modal('show');
						$('#exampleModalLongTitle').html('Buat Prediksi');
						$('.modal form').attr('action', 'User/Prediksi/savePrediksi');
					}
				}
			});
		});
		$('.editPrediksi').click(function() {
			$('.viewId').html('<input type="hidden" name="id" id="id">');
			$.ajax({
				url: "<?= site_url('User/Prediksi/modal') ?>",
				dataType: "json",
				success: function(response) {
					if (response.modal) {
						$('.viewModal').html(response.modal).show();
						$('#modalPrediksi').modal('show');
						$('.modal form').attr('action', 'User/Prediksi/editSave');
						$('#exampleModalLongTitle').html('Edit Data Prediksi');
					}
				}
			});
			$.ajax({
				type: "post",
				url: "<?= site_url('User/Prediksi/prediksiById') ?>",
				data: {
					id: $(this).data('id'),
				},
				dataType: "json",
				success: function(response) {
					if (response.data) {
						$('#id').val(response.data.id_prediksi);
						$('#lahan').val(response.data.lahan_prediksi);
						$('#bibit').val(response.data.bibit_prediksi);
						$('#organik').val(response.data.organik_prediksi);
						$('#anorganik').val(response.data.anorganik_prediksi);
					}
				}
			})
		})
		$('.btnpupuk').click(function(e) {
			var id = $(this).data('id');
			$.ajax({
				url: "<?= site_url('User/Prediksi/modal') ?>",
				dataType: "json",
				success: function(response) {
					if (response.modal) {
						$('.viewModal').html(response.modal).show();
						$('#modalPrediksi').modal('show');
						$('.modal form').attr('action', 'Prediksi/savePupuk');
						$('.predik').remove();
						$('.modal-lg').removeClass('modal-lg');
						$('.viewId').html(
							'<label for="inputEmail4"><b>Tanggal</b></label><input class="form-control" type="datetime-local" name="tanggal"id="tanggal"><label for="inputEmail4"><b>Jenis Pupuk</b></label><select name="nama_pupuk" id="nama_pupuk" class="form-control"><option value="organik">organik</option><option value="anorganik">anorganik</option></select><label for="inputEmail4"><b>Berat Pupuk</b></label><input type="number" class="form-control" name="berat_pupuk" id="berat_pupuk"><input type="hidden" class="form-control" name="idPrediksi" id="idPrediksi">'
						);
						$('#exampleModalLongTitle').html('Form Pemberian Pupuk');
						$('#idPrediksi').val(id);
					}
				}
			});
		})
		$('.btnhapuspupuk').click(function() {
			const id = $(this).data('id');
			swal({
				title: 'Apakah Anda Yakin?',
				text: "Data akan dihapus secara permanen!",
				icon: 'warning',
				buttons: {
					confirm: {
						text: 'Yes, delete it!',
						className: 'btn btn-success'
					},
					cancel: {
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					$.ajax({
						type: "post",
						url: "<?= site_url('User/Prediksi/hapusPupuk') ?>",
						data: {
							id: id
						},
						dataType: "json",
						success: function(response) {
							window.location.href = window.location.href;
							swal({
								title: 'SUCCESS',
								text: response.data,
								icon: 'success',
							});

						},
						error: function(xhr, ajaxOption, thrownError) {
							alert(xhr.status + "\n" + xhr.responseText + "\n" +
								thrownError);
						}
					});
				} else {
					swal.close();
				}
			});
		});
		$('.modalLaporanAir').click(function(e) {
			const id = $(this).data('id');
			$.ajax({
				url: "<?= site_url('User/Air/modalAir') ?>",
				dataType: "json",
				success: function(response) {
					if (response.modal) {
						$('.viewModal').html(response.modal).show();
						$('#modalPrediksi').modal('show');
						$('#idPrediksi').val(id);
					}
				},
			});
		});
		$('.ikanmati').click(function(e) {
			var id = $(this).data('id');
			$.ajax({
				url: "<?= site_url('User/Prediksi/modal') ?>",
				dataType: "json",
				success: function(response) {
					if (response.modal) {
						$('.viewModal').html(response.modal).show();
						$('#modalPrediksi').modal('show');
						$('.modal form').attr('action', 'Prediksi/saveIkanmati');
						$('.predik').remove();
						$('.modal-lg').removeClass('modal-lg');
						$('.viewId').html(
							'<label for="inputEmail4"><b>Tanggal</b></label><input class="form-control" type="datetime-local" name="tanggal"id="tanggal"><label for="inputEmail4"><b>Jumlah Ikan Mati</b></label><input type="number" class="form-control" name="jumlah_ikanmati" id="jumlah_ikanmati"><input type="hidden" class="form-control" name="idPrediksi" id="idPrediksi">'
						);
						$('#exampleModalLongTitle').html('Form Pemberian Pupuk');
						$('#idPrediksi').val(id);
					}
				}
			});
		});
		$('.hitungPrediksi').submit(function(e) {
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
					$('.hasilPY').html(response.PY);
					$('.hasilPX').html(response.PX);
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
		$('.hapusAir').click(function() {
			const id = $(this).data('id');
			swal({
				title: 'Apakah Anda Yakin?',
				text: "Data akan dihapus secara permanen!",
				icon: 'warning',
				buttons: {
					confirm: {
						text: 'Yes, delete it!',
						className: 'btn btn-success'
					},
					cancel: {
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					$.ajax({
						type: "post",
						url: "<?= site_url('User/Air/hapusAir') ?>",
						data: {
							id: id
						},
						dataType: "json",
						success: function(response) {
							swal({
								title: 'SUCCESS',
								text: response.data,
								icon: 'success',
								buttons: {
									confirm: {
										text: 'OK',
										className: 'btn btn-primary'
									},
								}
							}).then((Delete) => {
								if (Delete) {
									window.location.href = window.location.href;
									swal.close();
								}
							});

						},
						error: function(xhr, ajaxOption, thrownError) {
							alert(xhr.status + "\n" + xhr.responseText + "\n" +
								thrownError);
						}
					});
				} else {
					swal.close();
				}
			});
		});
		$('.hapusMati').click(function() {
			const id = $(this).data('id');
			swal({
				title: 'Apakah Anda Yakin?',
				text: "Data akan dihapus secara permanen!",
				icon: 'warning',
				buttons: {
					confirm: {
						text: 'Yes, delete it!',
						className: 'btn btn-success'
					},
					cancel: {
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					$.ajax({
						type: "post",
						url: "<?= site_url('User/Air/ikanMati') ?>",
						data: {
							id: id
						},
						dataType: "json",
						success: function(response) {
							swal({
								title: 'SUCCESS',
								text: response.data,
								icon: 'success',
								buttons: {
									confirm: {
										text: 'OK',
										className: 'btn btn-primary'
									},
								}
							}).then((Delete) => {
								if (Delete) {
									window.location.href = window.location.href;
									swal.close();
								}
							});

						},
						error: function(xhr, ajaxOption, thrownError) {
							alert(xhr.status + "\n" + xhr.responseText + "\n" +
								thrownError);
						}
					});
				} else {
					swal.close();
				}
			});
		})
	});
</script>
<?php $this->load->view('Layout/footer') ?>

</body>

</html>