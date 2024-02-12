<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Perpus_model');
		$this->load->helper('url'); // Load helper URL untuk fungsi base_url()
	}

	public function index() {
		$data['title'] = 'Home Perpustakaan';
		$this->load->view('global/layout', $data);
	}

	//halaman login
	public function log() {
		$cek = $this->session->userdata('logged_in');
		if(empty($cek)) {
			$data['title'] = 'Login & Register';
			$this->load->view('global/login', $data);
		} else {
			$st = $this->session->userdata('stts');
			if($st == 'admin') {
				redirect('admin/Home');
			} else if($st == 'petugas') {
				redirect('petugas/Home');
			}
		}
	}

	//mengambil data login
	public function login() {
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$this->Perpus_model->getLoginData($u,$p);
	}

	//logout
	public function logout() {
		$cek = $this->session->userdata('logged_in');
		if(empty($cek)) {
			redirect('web/log');
		} else {
			$this->session->sess_destroy();
			redirect('web/log');
		}
	}
}
