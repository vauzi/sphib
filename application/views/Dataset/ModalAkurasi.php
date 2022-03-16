<div class="modal form fade " id="ModalPrediksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $email = $this->session->userdata('email');
                $user = $this->db->get_where('user', ['email' => $email])->row_array();
                $ambil = $this->db->query("SELECT * FROM dataset WHERE status_data=2 AND id_user = ")->result_array();
                foreach ($ambil as $a) {
                }
                ?>
            </div>
            <div class="modal-footer tutup">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>