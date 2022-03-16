<?php $this->load->view('Layout/header') ?>
<?php $this->load->view('Layout/topbar') ?>
<?php $this->load->view('Layout/sidebar') ?>
<div class="pcoded-content">
	<div class="pcoded-inner-content">

		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						<div class="col-sm-12">

							<div class="card">
								<div class="card-header">
									<h5>Zero Configuration</h5>
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
													<table id="datauser" class="display nowrap table table-striped  table table-bordered bg-primary" style="width:100%">
														<thead>
															<tr>
																<th>No</th>
																<th>Username</th>
																<th>Email</th>
																<th>Satus Accaunt</th>
															</tr>
														</thead>
														<tbody class="text-dark">

														</tbody>
														<tfoot>
															<tr>
																<th>No</th>
																<th>Username</th>
																<th>Email</th>
																<th>Satus Accaunt</th>
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
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('Layout/footer') ?>
<script>
	$(document).ready(function() {
		userdata()

		function userdata() {

			var table = $('#datauser').DataTable({
				rowReorder: {
					selector: 'td:nth-child(2)'
				},
				responsive: true,
				"destroy": true,
				"processing": true,
				"serverSide": true,
				"order": [],
				"ajax": {
					"url": "<?= site_url('Welcome/ambildataUser') ?>",
					"type": "post",
				},

				"columnDefs": [{
					// "target": [0],
					// "orderable": false,
					// "width": s,
				}],
			});

		}
		// table = $('#datauser').DataTable({
		// 	responsive: true,

		// })

	})
</script>
</body>

</html>
