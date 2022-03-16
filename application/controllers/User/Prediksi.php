<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prediksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		user_logedIn();
		// $this->load->library('form');
		$this->load->model('modelAir');
	}
	public function index()
	{
		$level = $this->session->userdata('user_level');
		if ($level == 2) {
			# code...
			$email = $this->session->userdata('email');
			$user = $this->db->get_where('user', ['email' => $email])->row_array();
			$id_user = $user['id_user'];
			$query = "SELECT * FROM prediksi WHERE id_user = $id_user AND status_prediksi = 'on'";
			$data = [
				'title' 	=> 'Prediksi',
				'prediksi' 	=> $this->db->query($query)->result_array(),
				'id_user'	=> $id_user,
			];
			$this->load->view('Prediksi/index', $data);
		} else {
			$data = [
				'title' 	=> 'Prediksi',
			];
			$this->load->view('Prediksi/index', $data);
		}
	}
	public function modal()
	{
		$msg = [
			'modal' => $this->load->view('Prediksi/crudModal', '', true),
		];
		echo json_encode($msg);
	}
	public function savePrediksi()
	{
		$email = $this->session->userdata('email');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($this->input->is_ajax_request() == true) {
			$data = [
				'id_user' => $user['id_user'],
				'lahan_prediksi' => $this->input->post('lahan'),
				'bibit_prediksi' => $this->input->post('bibit'),
				'organik_prediksi' => $this->input->post('organik'),
				'anorganik_prediksi' => $this->input->post('anorganik'),
				'status_prediksi' => $this->input->post('status'),
			];
			$this->db->insert('prediksi', $data);
			$msg = [
				'data' => 'success',
			];
			echo json_encode($msg);
		}
	}
	public function prediksiById()
	{
		$id = $this->input->post('id');
		$msg = [
			'data' => $this->db->get_where('prediksi', ['id_prediksi' => $id])->row_array(),
		];
		echo json_encode($msg);
	}
	public function editSave()
	{
		if ($this->input->is_ajax_request() == true) {
			$id = ['id_prediksi' => $this->input->post('id')];
			$data = [
				'lahan_prediksi' => $this->input->post('lahan'),
				'bibit_prediksi' => $this->input->post('bibit'),
				'organik_prediksi' => $this->input->post('organik'),
				'anorganik_prediksi' => $this->input->post('anorganik'),
				'status_prediksi' => $this->input->post('status'),
			];
			$this->db->where($id)->update('prediksi', $data);
			$msg = [
				'data' => 'success',
			];
			echo json_encode($msg);
		}
	}
	public function savePupuk()
	{
		if ($this->input->is_ajax_request() == true) {
			$data = [
				'id_prediksi' 	=> $this->input->post('idPrediksi'),
				'nama_pupuk' 	=> $this->input->post('nama_pupuk'),
				'berat_pupuk' 	=> $this->input->post('berat_pupuk'),
				'tanggal_pupuk' => $this->input->post('tanggal'),
			];
			$this->db->insert('pupuk', $data);
			$msg = [
				'data' => 'Laporan Pupuk Berhasil Ditambahkan'
			];
			echo json_encode($msg);
		}
	}
	public function hapusPupuk()
	{
		if ($this->input->is_ajax_request() == true) {
			$id = ['id_pupuk' => $this->input->post('id')];
			$this->db->where($id)->delete('pupuk');
			$msg = [
				'data' => 'Laporan Pupuk berhasil DiHapus',
			];
		}
		echo json_encode($msg);
	}
	public function saveIkanmati()
	{
		if ($this->input->is_ajax_request() == true) {
			$data = [
				'id_prediksi' 		=> $this->input->post('idPrediksi'),
				'tanggal_mati' 		=> $this->input->post('tanggal'),
				'jumlah_ikanmati' 	=> $this->input->post('jumlah_ikanmati'),
			];
			$this->db->insert('ikanmati', $data);
			$msg = [
				'data' => $data
			];
			echo json_encode($msg);
		}
	}
	public function hitungprediksi()
	{
		$email = $this->session->userdata('email');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$id_user = $user['id_user'];
		if ($this->input->is_ajax_request() == true) {
			$kategori_lahan = $this->input->post('lahan');
			$rasioPupuk 	= $this->input->post('rasio');
			$kategori_air = $this->input->post('air');
			$tingkatHidup = $this->input->post('hidup');

			if ($user['user_level'] == 2) {

				$jmlDataset = $this->db->query("SELECT * FROM dataset WHERE status_data = 1 AND id_user = $id_user")->num_rows();
				$untung = $this->db->query("SELECT * FROM dataset WHERE class = 'UNTUNG' AND status_data = 1 AND id_user = $id_user")->num_rows();
				$rugi = $this->db->query("SELECT * FROM dataset WHERE class = 'RUGI' AND status_data = 1 AND id_user = $id_user")->num_rows();
				$p_untung = $untung / $jmlDataset;
				$p_rugi = $rugi / $jmlDataset;

				$px_untung = ($p_untung == 0) ? 0 : $p_untung;
				$px_rugi = ($p_rugi == 0) ?  0 : $p_rugi;

				$lahan_untung = $this->db->query("SELECT * FROM dataset WHERE kategori_lahan = '$kategori_lahan' AND status_data = 1 AND class = 'UNTUNG' AND id_user = $id_user")->num_rows();
				$lahan_rugi = $this->db->query("SELECT * FROM dataset WHERE kategori_lahan = '$kategori_lahan' AND status_data = 1 AND class = 'RUGI' AND id_user = $id_user")->num_rows();
				$p_lahan_untung = $lahan_untung / $untung;
				$p_lahan_rugi = $lahan_rugi / $rugi;

				$px_lahan_untung = ($p_lahan_untung == 0) ? 0 : $p_lahan_untung;
				$px_lahan_rugi = ($p_lahan_rugi == 0) ? 0 : $p_lahan_rugi;


				//end

				// jumlah dataset rasio user
				$rasio_untung = $this->db->query("SELECT * FROM dataset WHERE rasio = '$rasioPupuk' AND class = 'UNTUNG' AND status_data = 1 AND id_user = $id_user")->num_rows();
				$rasio_rugi = $this->db->query("SELECT * FROM dataset WHERE rasio = '$rasioPupuk' AND class = 'RUGI' AND status_data = 1 AND id_user = $id_user")->num_rows();
				$p_rasio_untung = $rasio_untung / $untung;
				$p_rasio_rugi = $rasio_rugi / $rugi;

				$px_rasio_untung = ($p_rasio_untung == 0) ? 0 : $p_rasio_untung;
				$px_rasio_rugi = ($p_rasio_rugi == 0) ? 0 : $p_rasio_rugi;



				//jumlah dataset kualitas air user
				$air_untung = $this->db->query("SELECT * FROM dataset WHERE kategori_air = '$kategori_air' AND class = 'UNTUNG' AND status_data = 1 AND id_user = $id_user")->num_rows();
				$air_rugi = $this->db->query("SELECT * FROM dataset WHERE kategori_air = '$kategori_air' AND class = 'RUGI' AND status_data = 1 AND id_user = $id_user")->num_rows();
				$p_air_untung = $air_untung / $untung;
				$p_air_rugi = $air_rugi / $rugi;

				$px_air_untung  = ($p_air_untung == 0) ? 0 : $p_air_untung;
				$px_air_rugi = ($p_air_rugi == 0) ? 0 : $p_air_rugi;
				//tingkat hidup
				$hidup_untung = $this->db->query("SELECT * FROM dataset WHERE tingkat_hidup = '$tingkatHidup' AND class = 'UNTUNG' AND status_data = 1 AND id_user = $id_user")->num_rows();
				$hidup_rugi = $this->db->query("SELECT * FROM dataset WHERE tingkat_hidup = '$tingkatHidup' AND class = 'RUGI' AND status_data = 1 AND id_user = $id_user")->num_rows();
				$p_hidup_untung = $hidup_untung / $untung;
				$p_hidup_rugi = $hidup_rugi / $rugi;

				$px_hidup_untung = ($p_hidup_untung == 0) ? 0 : $p_hidup_untung;
				$px_hidup_rugi = ($p_hidup_rugi == 0) ? 0 : $p_hidup_rugi;

				$PYH = $px_lahan_untung * $px_rasio_untung * $px_air_untung * $px_hidup_untung;
				$PXH = $px_lahan_rugi * $px_rasio_rugi * $px_air_rugi * $px_hidup_rugi;
				$PY = $PYH * $px_untung;
				$PX = $PXH * $px_rugi;
			} else {
				$jmlDataset = $this->db->query("SELECT * FROM dataset WHERE status_data = 1")->num_rows();
				$untung = $this->db->query("SELECT * FROM dataset WHERE class = 'UNTUNG' AND status_data = 1")->num_rows();
				$rugi = $this->db->query("SELECT * FROM dataset WHERE class = 'RUGI' AND status_data = 1")->num_rows();
				$p_untung = $untung / $jmlDataset;
				$p_rugi = $rugi / $jmlDataset;

				$px_untung = ($p_untung == 0) ? 0 : $p_untung;
				$px_rugi = ($p_rugi == 0) ?  0 : $p_rugi;

				$lahan_untung = $this->db->query("SELECT * FROM dataset WHERE kategori_lahan = '$kategori_lahan' AND status_data = 1 AND class = 'UNTUNG'")->num_rows();
				$lahan_rugi = $this->db->query("SELECT * FROM dataset WHERE kategori_lahan = '$kategori_lahan' AND status_data = 1 AND class = 'RUGI'")->num_rows();
				$p_lahan_untung = $lahan_untung / $untung;
				$p_lahan_rugi = $lahan_rugi / $rugi;

				$px_lahan_untung = ($p_lahan_untung == 0) ? 0 : $p_lahan_untung;
				$px_lahan_rugi = ($p_lahan_rugi == 0) ? 0 : $p_lahan_rugi;

				//end

				// jumlah dataset rasio user
				$rasio_untung = $this->db->query("SELECT * FROM dataset WHERE rasio = '$rasioPupuk' AND class = 'UNTUNG' AND status_data = 1")->num_rows();
				$rasio_rugi = $this->db->query("SELECT * FROM dataset WHERE rasio = '$rasioPupuk' AND class = 'RUGI' AND status_data = 1")->num_rows();
				$p_rasio_untung = $rasio_untung / $untung;
				$p_rasio_rugi = $rasio_rugi / $rugi;

				$px_rasio_untung = ($p_rasio_untung == 0) ? 0 : $p_rasio_untung;
				$px_rasio_rugi = ($p_rasio_rugi == 0) ? 0 : $p_rasio_rugi;



				//jumlah dataset kualitas air user
				$air_untung = $this->db->query("SELECT * FROM dataset WHERE kategori_air = '$kategori_air' AND class = 'UNTUNG' AND status_data = 1")->num_rows();
				$air_rugi = $this->db->query("SELECT * FROM dataset WHERE kategori_air = '$kategori_air' AND class = 'RUGI' AND status_data = 1")->num_rows();
				$p_air_untung = $air_untung / $untung;
				$p_air_rugi = $air_rugi / $rugi;

				$px_air_untung  = ($p_air_untung == 0) ? 0 : $p_air_untung;
				$px_air_rugi = ($p_air_rugi == 0) ? 0 : $p_air_rugi;
				//tingkat hidup
				$hidup_untung = $this->db->query("SELECT * FROM dataset WHERE tingkat_hidup = '$tingkatHidup' AND class = 'UNTUNG' AND status_data = 1")->num_rows();
				$hidup_rugi = $this->db->query("SELECT * FROM dataset WHERE tingkat_hidup = '$tingkatHidup' AND class = 'RUGI' AND status_data = 1")->num_rows();
				$p_hidup_untung = $hidup_untung / $untung;
				$p_hidup_rugi = $hidup_rugi / $rugi;

				$px_hidup_untung = ($p_hidup_untung == 0) ? 0 : $p_hidup_untung;
				$px_hidup_rugi = ($p_hidup_rugi == 0) ? 0 : $p_hidup_rugi;

				$PYH = $px_lahan_untung * $px_rasio_untung * $px_air_untung * $px_hidup_untung;
				$PXH = $px_lahan_rugi * $px_rasio_rugi * $px_air_rugi * $px_hidup_rugi;
				$PY = $PYH * $px_untung;
				$PX = $PXH * $px_rugi;
			}
			$msg = [
				'modal' 		=> $this->load->view('Prediksi/hitungModal', '', true),
				'untung' 		=> $px_untung,
				'rugi' 			=> $px_rugi,
				'lahan_untung' 	=> $px_lahan_untung,
				'lahan_rugi' 	=> $px_lahan_rugi,
				'rasio_untung'	=> $px_rasio_untung,
				'rasio_rugi' 	=> $px_rasio_rugi,
				'air_untung' 	=> $px_air_untung,
				'air_rugi' 		=> $px_air_rugi,
				'hidup_untung' 	=> $px_hidup_untung,
				'hidup_rugi' 	=> $px_hidup_rugi,
				'PYH'			=> $PYH,
				'PXH'			=> $PXH,
				'PY'			=> $PY,
				'PX'			=> $PX,
			];
			echo json_encode($msg);
		}
	}
}
