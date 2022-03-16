<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function index()
	{
		$data = [
			'title' => 'Data User',
		];
		$this->load->view('User/index', $data);
	}
	public function ambildataUser()
	{
		if ($this->input->is_ajax_request() == true) {
			$this->load->model('modelUser', 'user');
			$list = $this->user->get_datatables();
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				$no++;
				$row = array();
				$aksi = ["<a class=\"btn btn-success\">Active</a>"];
				$row[] = $no;
				$row[] = $field->username;
				$row[] = $field->email;
				$row[] = $field->is_active == 1 ? '<div class="badge badge-success">Active</div>' : '<div class="badge badge-danger">Non-active</div>';
				$row[] = $aksi;
				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->user->count_all(),
				"recordsFiltered" => $this->user->count_filtered(),
				"data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
		} else {
			exit('Maaf data tidak bisa ditampilkan');
		}
	}
}
