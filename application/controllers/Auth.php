<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data = [
			'title' => 'Login',
		];
		$this->load->view('Auth/Login', $data);
	}
	public function Register()
	{
		$config = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|is_unique[user.username]',
				'errors' => array(
					'required' => '%s Wajib di isi.',
					'is_unique' => '%s Sudah terdaftar.',
				),
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|is_unique[user.email]',
				'errors' => array(
					'required' => '%s Wajib Di ISI.',
					'is_unique' => '%s sudah terdaftar.',
				),
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|matches[passconf]|min_length[8]',
				'errors' => array(
					'required' 	=> '%s harus di isi.',
					'matches' 	=> '%s Tidak valid.',
					'min_length' => '%s minimal 8 karakter',
				),
			),
			array(
				'field' => 'passconf',
				'label' => 'Password Confirmation',
				'rules' => 'required|matches[password]',
				'errors' => array(
					'required' => '%s Wajib Di ISI.',
					'matches' => '%s Tidak valid.',
				),
			),

		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Auth/Register');
		} else {
			$data = [
				'username' 		=> $this->input->post('username'),
				'email' 		=> $this->input->post('email'),
				'password' 		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'user_level'	=> 2,
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('pesan', 'Pendaftaran akun baru berhasil di proses');
			return redirect('/');
		}
	}
	public function cek_login()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			if ($user['is_active'] == 1) {

				if (password_verify($pass, $user['password'])) {
					if ($user['user_level'] == 1) {
						$data = [
							'email'     => $user['email'],
							'username'     => $user['username'],
							'user_level' => $user['user_level'],
						];
						$this->session->set_userdata($data);
						return redirect('Admin/Dashboard');
					} else {
						$data = [
							'email'     => $user['email'],
							'username'     => $user['username'],
							'user_level' => $user['user_level'],
						];
						$this->session->set_userdata($data);
						return redirect('Admin/Dashboard');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger background-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="icofont icofont-close-line-circled text-white"></i>
					</button>
					<strong>Oooppss!</strong> Password yang anda masukkan salah!
				</div>');
					return redirect('/');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger background-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<i class="icofont icofont-close-line-circled text-white"></i>
				</button>
				<strong>Oooppss!</strong> Anda belum melakukan aktivasi accaount!
			</div>');
				return redirect('/');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger background-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<i class="icofont icofont-close-line-circled text-white"></i>
				</button>
				<strong>Oooppss!</strong>Email Belum Terdaftar
			</div>');
			return redirect('Auth');
		}
	}
	public function logout()
	{
		// $email = $this->session->userdata('email');
		// $username = $this->session->userdata('username');
		// $level = $this->session->userdata('user_level');
		// echo $email, $username, $level;
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('user_level');
		return redirect('/');
	}
}
