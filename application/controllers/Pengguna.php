<?php

use Dompdf\Dompdf;

class Pengguna extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata['status'] != 'SPAREPART' && $this->session->userdata['status'] != 'KABENG' && $this->session->userdata['status'] != 'OUTLET') {
			redirect('Auth');
		}
		$this->data['aktif'] = 'pengguna';
		$this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index(){
		
		$this->data['title'] = 'Data Karyawan';
		$this->data['all_pengguna'] = $this->m_pengguna->lihat();
		$this->data['no'] = 1;

		$this->load->view('pengguna/lihat', $this->data);
	}

	public function tambah(){

		$this->data['title'] = 'Tambah Pengguna';

		$this->load->view('pengguna/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode_karyawan' => $this->input->post('kode_karyawan'),
			'nama_karyawan' => $this->input->post('nama_karyawan'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
			'no_tlp' => $this->input->post('no_tlp'),
			'status' => $this->input->post('status'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
		];

		if($this->m_pengguna->tambah($data)){
			$this->session->set_flashdata('success', 'Data Karyawan <strong>Berhasil</strong> Ditambahkan!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Karyawan <strong>Gagal</strong> Ditambahkan!');
			redirect('pengguna');
		}
	}

	public function ubah($id){
		
		$this->data['title'] = 'Ubah Karyawan';
		$this->data['pengguna'] = $this->m_pengguna->lihat_id($id);

		$this->load->view('pengguna/ubah', $this->data);
	}

	public function proses_ubah($id){

		$data = [
			'kode_karyawan' => $this->input->post('kode_karyawan'),
			'nama_karyawan' => $this->input->post('nama_karyawan'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
			'no_tlp' => $this->input->post('no_tlp'),
			'status' => $this->input->post('status'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
		];

		if($this->m_pengguna->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data Karyawan <strong>Berhasil</strong> Diubah!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Karyawan <strong>Gagal</strong> Diubah!');
			redirect('pengguna');
		}
	}

	public function hapus($id){

		if($this->m_pengguna->hapus($id)){
			$this->session->set_flashdata('success', 'Data Karyawan <strong>Berhasil</strong> Dihapus!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Karyawan <strong>Gagal</strong> Dihapus!');
			redirect('pengguna');
		}
	}

	public function detail($kode_karyawan){
		$this->data['title'] = 'Detail Karyawan';
		$this->data['karyawan'] = $this->m_pengguna->detail_karyawan($kode_karyawan)->row();
		$this->data['no'] = 1;

		$this->load->view('pengguna/detail', $this->data);

	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_pengguna'] = $this->m_pengguna->lihat();
		$this->data['title'] = 'Laporan Data Karyawan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengguna/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Karyawan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}