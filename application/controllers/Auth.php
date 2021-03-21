<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_data');
	}

	public function index() {	
		$this->load->view('login');
		$this->session->sess_destroy();
	}

	public function cekLogin() {
		$username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
		$password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);

		$cek=$this->M_data->log($username,$password); //cek pada model M_Admin method log

		if ($cek->num_rows() > 0) {
			foreach ($cek->result() as $sess) {
				$sess_data['kode_karyawan'] = $sess->kode_karyawan;
				$sess_data['username'] = $sess->username;
				$sess_data['nama_karyawan'] = $sess->nama_karyawan;
				$sess_data['status'] = $sess->status;

				$this->session->set_userdata($sess_data);
			}
			if ($this->session->userdata('status')=='SPAREPART') { 		
				redirect('dashboard');
			} elseif ($this->session->userdata('status')=='KABENG') { 	
				redirect('dashboard');
			} else { 									
				redirect('dashboard');
			}
		} else {
			echo "<script>alert('Gagal login: Cek username & password !!!');history.go(-1);</script>";
		}
	}


}
