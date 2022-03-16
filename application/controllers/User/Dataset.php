<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataset extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		user_logedIn();
		// $this->load->library('form');
	}
	public function index()
	{
		$email = $this->session->userdata('email');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$id_user = $user['id_user'];
		$data = [
			'title' => 'Dataset',
			'dataset' => $this->db->get_where('dataset', ['id_user' => $id_user])->result_array(),
		];
		$this->load->view('Dataset/index', $data);
	}
	public function ambilDataset()
	{
		$email = $this->session->userdata('email');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$id_user = $user['id_user'];
		if ($this->input->is_ajax_request() == true) {

			$this->load->model('modelDataset', 'dataset');
			$list = $this->dataset->get_datatables();
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {
				if ($field->status_data == 1) {
					$status = ['<div  class="badge badge-primary btn-sm">Data Trining</div>'];
				} else {
					$status = ['<div  class="badge badge-danger btn-sm">Data Testing</div>'];
				}
				$aksi = [
					"<div class=\"dropdown-primary dropdown open\"><button class=\"btn btn-info dropdown-toggle waves-effect waves-light \" type=\"button\" id=\"dropdown-2\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Aksi</button><div class=\"dropdown-menu\" aria-labelledby=\"dropdown-2\" data-dropdown-in=\"fadeIn\" data-dropdown-out=\"fadeOut\">
					<a class=\"dropdown-item waves-light waves-effect\" onclick=\"detail('" . $field->id_data . "')\">Detail</a>
					<a class=\"dropdown-item waves-light waves-effect\" onclick=\"edit('" . $field->id_data . "')\">Edit</a>
					<a class=\"dropdown-item waves-light waves-effect\" onclick=\"hapus('" . $field->id_data . "')\">Hapus</a>
					</div></div>"
				];
				$no++;
				$row = array();

				$row[] = $no;
				$row[] = $field->kategori_lahan;
				$row[] = $field->rasio;
				$row[] = $field->kategori_air;
				$row[] = $field->tingkat_hidup;
				$row[] = $status;
				$row[] = $field->class;
				$row[] = $aksi;
				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->dataset->count_all($id_user),
				"recordsFiltered" => $this->dataset->count_filtered($id_user),
				"data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
		} else {
			exit('Maaf data tidak bisa ditampilkan');
		}
	}
	public function kategori()
	{
		$msg = [
			'data' => $this->input->post('lahan'),
		];
		echo json_encode($msg);
	}
	public function modal()
	{
		if ($this->input->is_ajax_request() == true) {
			$msg = [
				'modal' => $this->load->view('Dataset/crudModal', '', true),
			];
			echo json_encode($msg);
		}
	}
	public function savedata()
	{
		$email = $this->session->userdata('email');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$id_user = $user['id_user'];
		$luasLahan  	= $this->input->post('lahan');
		$jumlahBibit 	= $this->input->post('bibit');
		$air        	= $this->input->post('air');
		$organik    	= $this->input->post('organik');
		$anorganik  	= $this->input->post('anorganik');
		$beratTotal 	= $this->input->post('panen');
		$beratPerekor 	= $this->input->post('perekor');
		// lategori lahan
		if ($luasLahan >= 6000) {
			$kategoriLahan = 'LUAS';
		} elseif ($luasLahan >= 1500) {
			$kategoriLahan = 'SEDANG';
		} else {
			$kategoriLahan = 'KECIL';
		}
		//rasio pupuk
		$jumlahPupuk = $organik + $anorganik;
		$bobotOrganik =  $organik / $jumlahPupuk;
		$bobotAnorganik =  $anorganik / $jumlahPupuk;
		$persentasePupuk = $bobotAnorganik / $bobotOrganik;
		if ($persentasePupuk > 1.6) {
			$rasioPupuk = "TINGGI";
		} elseif ($persentasePupuk > 1.3) {
			$rasioPupuk = "SEDANG";
		} else {
			$rasioPupuk = "RENDAH";
		}
		//kategori Air
		if ($air > 80) {
			$kategoriAir = "SANGAT SESUAI";
		} elseif ($air > 65) {
			$kategoriAir = "CUKUP SESUAI";
		} else {
			$kategoriAir = "HAMPIR SESUAI";
		}
		//tingkat kehidupan
		$jumlahIkan = $beratTotal * 1000 / $beratPerekor;
		$tingkatHidup = $jumlahIkan / $jumlahBibit * 100;
		if ($tingkatHidup > 26) {
			$tingkatHidupkategori = "BAIK";
		} else {
			$tingkatHidupkategori = "KURANG BAIK";
		}
		//class
		if ($kategoriLahan == 'LUAS') {
			if ($beratTotal > 1000) {
				$class = "UNTUNG";
			} else {
				$class = "RUGI";
			}
		} elseif ($kategoriLahan == 'SEDANG') {
			if ($beratTotal > 500) {
				$class = "UNTUNG";
			} else {
				$class = "RUGI";
			}
		} else {
			if ($beratTotal > 200) {
				$class = "UNTUNG";
			} else {
				$class = "RUGI";
			}
		}
		$data = [
			'luas_lahan'    => $luasLahan,
			'id_user'		=> $id_user,
			'jumlah_bibit'  => $jumlahBibit,
			'organik'       => $organik,
			'anorganik'     => $anorganik,
			'kualitas_air'  => $air,
			'berat_total'   => $beratTotal,
			'berat_perekor' => $beratPerekor,
			'kategori_lahan' => $kategoriLahan,
			'rasio'         => $rasioPupuk,
			'kategori_air'  => $kategoriAir,
			'tingkat_hidup' => $tingkatHidupkategori,
			'class'         => $class,
			'status_data'   => $this->input->post('status'),
		];
		$this->db->insert('dataset', $data);
		$msg = [
			'hasil' => 'Data Berhasil Di Tambahkan',
		];
		echo json_encode($msg);
	}
	public function datasetById()
	{
		$id = $this->input->post('idData');
		$msg = [
			'data' => $this->db->get_where('dataset', ['id_data' => $id])->row_array(),
		];
		echo json_encode($msg);
	}
	public function updatedata()
	{
		$email = $this->session->userdata('email');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$id_user = $user['id_user'];

		$luasLahan  = $this->input->post('lahan');
		$jumlahBibit = $this->input->post('bibit');
		$air        = $this->input->post('air');
		$organik    = $this->input->post('organik');
		$anorganik  = $this->input->post('anorganik');
		$beratTotal = $this->input->post('panen');
		$beratPerekor = $this->input->post('perekor');
		// lategori lahan
		if ($luasLahan > 6000) {
			$kategoriLahan = 'LUAS';
		} elseif ($luasLahan > 1500) {
			$kategoriLahan = 'SEDANG';
		} else {
			$kategoriLahan = 'KECIL';
		}
		//rasio pupuk
		$jumlahPupuk = $organik + $anorganik;
		$bobotOrganik =  $organik / $jumlahPupuk;
		$bobotAnorganik = $anorganik / $jumlahPupuk;
		$persentasePupuk = $bobotAnorganik / $bobotOrganik;
		if ($persentasePupuk > 1.6) {
			$rasioPupuk = "TINGGI";
		} elseif ($persentasePupuk > 1.3) {
			$rasioPupuk = "SEDANG";
		} else {
			$rasioPupuk = "RENDAH";
		}
		//kategori Air
		if ($air > 80) {
			$kategoriAir = "SANGAT SESUAI";
		} elseif ($air > 65) {
			$kategoriAir = "CUKUP SESUAI";
		} else {
			$kategoriAir = "HAMPIR SESUAI";
		}
		//tingkat kehidupan
		$jumlahIkan = $beratTotal * 1000 / $beratPerekor;
		$tingkatHidup = $jumlahIkan / $jumlahBibit * 100;
		if ($tingkatHidup >= 26) {
			$tingkatHidupkategori = "BAIK";
		} else {
			$tingkatHidupkategori = "KURANG BAIK";
		}
		//class
		if ($kategoriLahan == 'LUAS') {
			if ($beratTotal > 1000) {
				$class = "UNTUNG";
			} else {
				$class = "RUGI";
			}
		} elseif ($kategoriLahan == 'SEDANG') {
			if ($beratTotal > 500) {
				$class = "UNTUNG";
			} else {
				$class = "RUGI";
			}
		} else {
			if ($beratTotal > 200) {
				$class = "UNTUNG";
			} else {
				$class = "RUGI";
			}
		}
		$id = array('id_data' => $this->input->post('idData'));
		$data = [
			'luas_lahan'    => $luasLahan,
			'id_user'		=> $id_user,
			'jumlah_bibit'  => $jumlahBibit,
			'organik'       => $organik,
			'anorganik'     => $anorganik,
			'kualitas_air'  => $air,
			'berat_total'   => $beratTotal,
			'berat_perekor' => $beratPerekor,
			'kategori_lahan' => $kategoriLahan,
			'rasio'         => $rasioPupuk,
			'kategori_air'  => $kategoriAir,
			'tingkat_hidup' => $tingkatHidupkategori,
			'class'         => $class,
			'status_data'   => $this->input->post('status'),
		];

		$this->db->where($id)->update('dataset', $data);
		$msg = [
			'hasil' => 'Data Berhasil Di Ubah',
		];
		echo json_encode($msg);
	}
	public function hapusDataset()
	{
		$id = ['id_data' => $this->input->post('id')];
		$this->db->where($id)->delete('dataset');
		$msg = [
			'data' => 'success',
		];
		echo json_encode($msg);
	}
	public function modalakurasi()
	{
		if ($this->input->is_ajax_request() == true) {
			$msg = [
				'modal' => $this->load->view('Dataset/ModalAkurasi', '', true),
			];
			echo json_encode($msg);
		}
	}
}
