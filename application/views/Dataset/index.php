<?php $this->load->view('Layout/header') ?>
<?php $this->load->view('Layout/topbar') ?>
<?php $this->load->view('Layout/sidebar', $title) ?>


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

							<div class="card">
								<div class="card-header">
									<button class="btn btn-info" id="input"><i class="fa fa-plus-square"></i>Tambah Dataset</button>
									<button class="btn btn-warning" onclick="modalprediksi()" id="akurasi"><i class="fa fa-plus-square"></i>Cek Akurasi</button>
									<div class="card-header-right">
										<i class="icofont icofont-rounded-down"></i>
										<i class="icofont icofont-refresh"></i>
										<i class="icofont icofont-close-circled"></i>
									</div>
								</div>
								<div class="card-block">
									<div class="dt-responsive table-responsive">
										<div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
											<div class="row">
												<div class="col-xs-12 col-sm-12">
													<table id="dataset" class="display nowrap table table-striped  table table-bordered bg-primary" style="width:100%">
														<thead>
															<tr>
																<th>No</th>
																<th>Lahan</th>
																<th>Rasio Pupuk</th>
																<th>Kualitas Air</th>
																<th>Tingkat Kelolosan Hidup</th>
																<th>Status Data</th>
																<th>Class</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody class="text-dark">

														</tbody>
														<tfoot>
															<tr>
																<th>No</th>
																<th>Lahan</th>
																<th>Rasio Pupuk</th>
																<th>Kualitas Air</th>
																<th>Tingkat Kelolosan Hidup</th>
																<th>Status Data</th>
																<th>Class</th>
																<th>Action</th>
															</tr>
														</tfoot>
													</table>
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

			</div>
		</div>
	</div>
</div>
<div class="viewModal" style="display: none;"></div>
<script>
	//dataTables
	getDataset();

	function getDataset() {

		var table = $('#dataset').DataTable({
			rowReorder: {
				selector: 'td:nth-child(2)'
			},
			responsive: true,
			"destroy": true,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?= site_url('User/Dataset/ambilDataset') ?>",
				"type": "post",
			},

			"columnDefs": [{
				// "target": [0],
				// "orderable": false,
				// "width": s,
			}],
		});

	}
	//form input dataset
	$('#input').click(function() {
		$.ajax({
			url: "<?= site_url('User/Dataset/modal') ?>",
			dataType: "json",
			success: function(response) {
				if (response.modal) {
					$('.viewModal').html(response.modal).show();
					$('#formModal').modal('show');
					$('.editOn').hide();
					$('.modal-title').html('Tambah Dataset');
				}
			},
			error: function(xhr, ajaxOption, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});

	});
	//aktif form
	function editon() {
		$('.editOn').click(function() {
			$('.editOn').hide();
			$('.btnsave').show();
			$('#lahan').removeAttr('disabled');
			$('#bibit').removeAttr('disabled');
			$('#organik').removeAttr('disabled')
			$('#anorganik').removeAttr('disabled');
			$('#air').removeAttr('disabled');
			$('#panen').removeAttr('disabled');
			$('#perekor').removeAttr('disabled');
			$('#status').removeAttr('disabled');
			$('.modal-title').html('Edit Data');
		});
	}
	//modal edit
	function detail(idData) {
		$.ajax({
			url: "<?= site_url('User/Dataset/modal') ?>",
			dataType: "json",
			success: function(response) {
				if (response.modal) {
					$('.viewModal').html(response.modal).show();
					$('#formModal').modal('show');
					$('.modal form').attr('action', 'Dataset/updatedata');
					$('.viewId').html('<input type="hidden" name="idData" id="idData">');
					$('.btnsave').hide();
					$('.editOn').show();
					$('.modal-title').html('Detail Data');
					editon()
					document.getElementById('lahan').disabled = true;
					document.getElementById('bibit').disabled = true;
					document.getElementById('organik').disabled = true;
					document.getElementById('anorganik').disabled = true;
					document.getElementById('anorganik').disabled = true;
					document.getElementById('air').disabled = true;
					document.getElementById('panen').disabled = true;
					document.getElementById('perekor').disabled = true;
					document.getElementById('status').disabled = true;
				}
			},
			error: function(xhr, ajaxOption, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
		//ambil Data bY Id
		$.ajax({
			type: "post",
			data: {
				idData: idData
			},
			url: "<?= site_url('User/Dataset/datasetById') ?>",
			dataType: "json",
			success: function(response) {
				if (response.data) {
					$('#idData').val(response.data.id_data);
					$('#lahan').val(response.data.luas_lahan);
					$('#bibit').val(response.data.jumlah_bibit);
					$('#organik').val(response.data.organik)
					$('#anorganik').val(response.data.anorganik);
					$('#air').val(response.data.kualitas_air);
					$('#panen').val(response.data.berat_total);
					$('#perekor').val(response.data.berat_perekor);
					$('#status').val(response.data.status_data);
				}

			},
			error: function(xhr, ajaxOption, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});

	}

	function edit(idData) {
		$.ajax({
			url: "<?= site_url('User/Dataset/modal') ?>",
			dataType: "json",
			success: function(response) {
				if (response.modal) {
					$('.viewModal').html(response.modal).show();
					$('#formModal').modal('show');
					$('.modal form').attr('action', 'Dataset/updatedata');
					$('.viewId').html('<input type="hidden" name="idData" id="idData">');
					$('.modal-title').html('Edit Data');
					$('.editOn').hide();

				}
			},
			error: function(xhr, ajaxOption, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
		//ambil Data bY Id
		$.ajax({
			type: "post",
			data: {
				idData: idData
			},
			url: "<?= site_url('User/Dataset/datasetById') ?>",
			dataType: "json",
			success: function(response) {
				if (response.data) {
					$('#idData').val(response.data.id_data);
					$('#lahan').val(response.data.luas_lahan);
					$('#bibit').val(response.data.jumlah_bibit);
					$('#organik').val(response.data.organik)
					$('#anorganik').val(response.data.anorganik);
					$('#air').val(response.data.kualitas_air);
					$('#panen').val(response.data.berat_total);
					$('#perekor').val(response.data.berat_perekor);
					$('#status').val(response.data.status_data);
				}

			},
			error: function(xhr, ajaxOption, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}

		});
	}

	function hapus(idData) {
		swal({
			title: 'Apakah Anda Yakin?',
			text: "Data akan dihapus secara permanen!",
			type: 'warning',
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
					url: "<?= site_url('User/Dataset/hapusDataset') ?>",
					data: {
						id: idData
					},
					dataType: "json",
					success: function(response) {
						console.log(response.data);
						getDataset();


					},
					error: function(xhr, ajaxOption, thrownError) {
						alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
					}
				});
			} else {
				swal.close();

			}
		});
	}

	function modalprediksi() {
		$.ajax({
			url: " <?= site_url('User/Dataset/modalakurasi') ?>",
			dataType: "json",
			success: function(response) {
				if (response.modal) {
					$('.viewModal').html(response.modal).show();
					$('#ModalPrediksi').modal('show');
					$('.load').hide();
				}
			},
			error: function(xhr, ajaxOption, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		})
	}
</script>
<?php $this->load->view('Layout/footer') ?>

</body>

</html>