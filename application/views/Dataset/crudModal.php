<div class="modal form fade " id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('User/Dataset/savedata', ['class' => 'savedata']); ?>
			<div class="modal-body buka" id="buka">
				<div class="form-group row">
					<div class="viewId"></div>
					<div class="col">
						<label for="inputEmail4"><b>Luas Lahan (m2)</b></label>
						<input type="number" name="lahan" id="lahan" class="form-control" placeholder="luas lahan">
					</div>
					<div class="col-sm-4">
						<label for="inputEmail4"><b>Jumlah Bibit</b></label>
						<input type="number" name="bibit" id="bibit" class="form-control" placeholder="Jumlah Benih/glondong yang ditebar">
					</div>
					<div class="col">
						<label for="inputEmail4"><b>Jumlah Pupuk Organik /Kg</b></label>
						<input type="number" class="form-control" name="organik" id="organik" placeholder="berat pupuk yang di tebar">
					</div>
				</div>
				<div class="form-group row">
					<div class="col">
						<label for="inputEmail4"><b>Jumlah Pupuk Anorganik /Kg</b></label>
						<input type="number" class="form-control" name="anorganik" id="anorganik" placeholder="Berat Pupuk yang ditebar">
					</div>
					<div class="col-sm-4">
						<label for="inputEmail4"><b>Kualitas Air (%)</b></label>
						<input type="number" class="form-control" name="air" id="air" placeholder="Kualitas Air %">
					</div>
					<div class="col">
						<label for="inputEmail4"><b>Hasil Panen (Kg)</b></label>
						<input type="number" name="panen" id="panen" class="form-control" placeholder="Berat Total Hasil Panen /Kg">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6">
						<label for="inputEmail4"><b>Berat Perekor(g)</b></label>
						<input type="number" name="perekor" id="perekor" class="form-control" placeholder="Berat Perekor /g">
					</div>
					<div class="col-sm-6">
						<label for="inputEmail4"><b>Status Data</b></label>
						<select type="number" name="status" id="status" class="form-control">
							<option value="1">Data Trining</option>
							<option value="2">Data Testing</option>
						</select>
					</div>
					<!-- <div class="col-sm-6">
						<label for=""><b>Status Data</b></label>
						<div class="form-radio">
							<div class="radio radio-inline">
								<label>
									<input type="radio" name="status_data" id="status_data" value="1">
									<i class="helper"></i>Data Trining
								</label>
							</div>
							<div class="radio radiofill radio-danger radio-inline">
								<label>
									<input type="radio" name="status_data" id="status_data" value="2">
									<i class="helper"></i>Data Testing
								</label>
							</div>
						</div>
					</div> -->
				</div>
			</div>
			<div class="modal-footer tutup">
				<div class="formId"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btnsave">
					Save changes
				</button>
				<button type="button" class="btn btn-info editOn">
					edit
				</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(e) {
		$('.savedata').submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: "post",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: "json",
				beforeSend: function() {
					$('.btnsave').removeData('disable');
					$('.btnsave').html('<i class = "fa fa-spin fa-spinner"></i>');
				},
				complete: function() {
					$('.btnsave').removeAttr('disable');
					$('.btnsave').html('Save changes');
				},
				success: function(response) {
					if (response.hasil) {
						console.log(response.hasil);
						$('#formModal').modal('hide');
						getDataset();
						swal({
							title: 'Success',
							text: response.hasil,
							type: 'success',
						})

					} else {}
				},
				error: function(xhr, ajaxOption, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
		});
	});
</script>