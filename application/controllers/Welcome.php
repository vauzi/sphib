<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function coba()
	{
		$this->load->view('datatable');
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

				$row[] = $no;
				$row[] = $field->username;
				$row[] = $field->email;
				$row[] = $field->is_active == 1 ? '<div class="badge badge-success">Active</div>' : '<div class="badge badge-danger">Non-active</div>';
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
