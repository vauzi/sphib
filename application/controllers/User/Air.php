<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Air extends CI_Controller
{
    public function saveAir()
    {
        if ($this->input->is_ajax_request() == true) {
            $data = [
                'id_prediksi'     => $this->input->post('idPrediksi'),
                'tanggal'           => $this->input->post('tanggal'),
                'kualitas'     => $this->input->post('kualitas'),
            ];
            $this->db->insert('air', $data);
            $msg = [
                'data' => 'Permintaan Berhasil Diproses'
            ];
            echo json_encode($msg);
        } else {
            return redirect('User/Prediksi');
        }
    }
    public function modalAir()
    {
        if ($this->input->is_ajax_request() == true) {
            $msg = [
                'modal' => $this->load->view('Prediksi/modalAir', '', true),
            ];
            echo json_encode($msg);
        }
    }
    public function hapusAir()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id');
            $this->db->where(['id_air' => $id])->delete('air');
            $msg = [
                'data' => 'Permintaan Berhasil Diproses',
            ];
        }
        echo json_encode($msg);
    }
    public function ikanMati()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id');
            $this->db->where(['id_ikanmati' => $id])->delete('ikanmati');
            $msg = [
                'data' => 'Permintaan Berhasil Diproses',
            ];
        }
        echo json_encode($msg);
    }
}
