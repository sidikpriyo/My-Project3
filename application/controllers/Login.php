<?php

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->login) redirect('dashboard');
		$this->load->model('M_pengguna', 'm_pengguna');
		$this->load->model('M_data', 'mod_user');
	}

	public function index(){
		$this->load->view('login');
	}

	public function proses_login(){
		if($this->input->post('role') === 'sparepart') $this->_proses_login_sparepart($this->input->post('username'));
		elseif($this->input->post('role') === 'kabeng') $this->_proses_login_kabeng($this->input->post('username'));
		elseif($this->input->post('role') === 'outlet') $this->_proses_login_outlet($this->input->post('username'));
		else {
			?>
			<script>
				alert('role tidak tersedia!')
			</script>
			<?php
		}
	}

	public function cekLogin() {
		$username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
		$password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);

		$cek=$this->mod_user->log($username,$password); //cek pada model M_Admin method log

		if ($cek->num_rows() > 0) {
			foreach ($cek->result() as $sess) {
				$sess_data['kode_karyawan'] = $sess->kode_karyawan;
				$sess_data['username'] 		= $sess->username;
				$sess_data['nama_karyawan'] = $sess->nama_karyawan;
				$sess_data['status'] 		= $sess->status;

				$this->session->set_userdata($sess_data);
			}
			if ($this->session->userdata('status')=='KABENG') { 		//akses admin produk
				redirect('dashboard');
			} elseif ($this->session->userdata('status')=='OUTLET') { 	//akses admin user
				redirect('dashboard');
			} else { 														//akses admin laporan
				redirect('dashboard');
			}
		} else {
			echo "<script>alert('Gagal login: Cek username & password !!!');history.go(-1);</script>";	
		}
	}
}