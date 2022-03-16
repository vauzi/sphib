<div class="modal form fade " id="modalPrediksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Kualitas Air</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('User/Air/saveAir', ['class' => 'saveAir']); ?>
            <div class="modal-body buka" id="buka">
                <label for="inputEmail4"><b>Tanggal</b></label>
                <input class="form-control" type="datetime-local" name="tanggal" id="tanggal">

                <label for="inputEmail4"><b>Kualitas Air</b></label>
                <input type="range" name="air" id="air" class="form-control">

                <input type="number" class="form-control" name="kualitas" id="kualitas">

                <input type="hidden" class="form-control" name="idPrediksi" id="idPrediksi">
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
        $(document).ready(function() {
            $('.saveAir').submit(function(e) {
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
                        if (response.data) {
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
                            $('#modalPrediksi').modal('hide');
                            console.log(response.data);
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