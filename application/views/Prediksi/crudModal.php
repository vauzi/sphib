<div class="modal form fade " id="modalPrediksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('User/Prediksi/savePrediksi', ['class' => 'savedataPrediksi']); ?>
			<div class="modal-body buka" id="buka">
				<div class="form-group">
					<div class="viewId"></div>
				</div>
				<div class="form-group row predik">
					<div class="col">
						<label for="inputEmail4"><b>Luas Lahan (m2)</b></label>
						<input type="number" name="lahan" id="lahan" class="form-control" placeholder="luas lahan">
					</div>

				</div>
				<div class="form-group row predik">
					<div class="col">
						<label for="inputEmail4"><b>Jumlah Bibit</b></label>
						<input type="number" name="bibit" id="bibit" class="form-control" placeholder="Jumlah Benih/glondong yang ditebar">
					</div>
					<input type="hidden" class="form-control" name="status" id="status" value="on">
				</div>

			</div>
			<div class="modal-footer tutup">
				<div class="formId"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btnsave">
					Save changes
				</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(e) {
		$('.savedataPrediksi').submit(function(e) {
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
					window.location.href = window.location.href;
					if (response.data) {
						swal({
							title: 'SUCCESS',
							text: response.data,
							type: 'warning',
						});
						$('#modalPrediksi').modal('hide');
						console.log(response.data)
					} else {
						$('#modalPrediksi').modal('hide');
					}
				},
				error: function(xhr, ajaxOption, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
		});
	});
</script>