<div class="modal form fade " id="modalPrediksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body buka" id="buka">
				<ul>
					<li class="col-sm-3">
						<h6><strong>P(X)</strong></h6>
						<dt class="d-flex">
							<h6>Untung:</h6>
							<h6 class="untung ml-5">:</h6>
						</dt>
						<dt class="d-flex">
							<h6>Rugi:</h6>
							<h6 class="rugi ml-5">:</h6>
						</dt>
					</li>
				</ul>
			</div>
			<hr>
			<div class="mx-auto">
				<div class="ml-3">
					<dt class="col-sm-4">
						<h5><strong>P(X|H)</strong></h5>
					</dt>
					<hr>
					<div class="d-flex">
						<ul>
							<p class="mx-auto">Untung</p>
							<hr>
							<dl class="row ">
								<dt class="col-sm-4">Lahan</dt>
								<dd class="col-sm-8 lahanuntung"></dd>

								<dt class="col-sm-4">Rasio</dt>
								<dd class="col-sm-8 rasiountung"></dd>


								<dt class="col-sm-4">Kualitas Air</dt>
								<dd class="col-sm-8 airuntung"></dd>


								<dt class="col-sm-4">Tingkat Hidup</dt>
								<dd class="col-sm-8 hidupuntung"></dd>

								<h3 class="col-sm-4 mt-3">Untung</h3>
								<dd class="col-sm-8 mt-4 hasilPYH"></dd>
							</dl>
						</ul>
						<ul>
							<p class="mx-auto">Rugi</p>
							<hr>
							<dl class="row">
								<dt class="col-sm-4">Lahan</dt>
								<dd class="col-sm-8 lahanrugi"></dd>


								<dt class="col-sm-4">Rasio</dt>
								<dd class="col-sm-8 rasiorugi"></dd>


								<dt class="col-sm-4">Kualitas Air</dt>
								<dd class="col-sm-8 airrugi"></dd>


								<dt class="col-sm-4">Tingkat Hidup</dt>
								<dd class="col-sm-8 hiduprugi"></dd>

								<h3 class="col-sm-4 mt-3">Rugi</h3>
								<dd class="col-sm-8 mt-4 hasilPXH"></dd>
							</dl>
						</ul>
					</div>
				</div>
				<!-- <div class="col-lg-5">
					<dd class="col-sm-8 hasilPXH"></dd>
					<hr>

				</div> -->
			</div>
			<div class="modal-footer tutup">
				<div class="d-betwen">
					<h4><strong>Output Untung : </strong><strong class="hasilPY "></strong></h4>
					<h4><strong>Output Rugi : </strong><strong class="hasilPX "></strong></h4>
				</div>
				<div class="mx-auto">
					<h4><strong>Hasil Prediksi : </strong>
						<div class="HasilPrediksi badge badge-success"></div>
					</h4>
				</div>
			</div>
			<div class="modal-footer tutup">
				<div class="formId"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>