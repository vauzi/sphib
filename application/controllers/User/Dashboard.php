<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$email = $this->session->userdata('email');
		$data = [
			'title' => 'Dashboard',
			'user' => $this->db->get_where('user', ['email' => $email])->row_array(),
		];
		$this->load->view('Dashboard/index', $data);
	}
}
