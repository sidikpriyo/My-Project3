<?php

use Dompdf\Dompdf;

class Pelanggan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata['status'] != 'SPAREPART' && $this->session->userdata['status'] != 'KABENG' && $this->session->userdata['status'] != 'OUTLET') {
			redirect('Auth');
		}
		$this->load->model('M_pelanggan', 'm_pelanggan');
		$this->data['aktif'] = 'pelanggan';
	}

	public function index(){
		$this->data['title'] = 'Data Pelanggan';
		$this->data['all_customer'] = $this->m_pelanggan->lihat();
		$this->data['no'] = 1;

		$this->load->view('pelanggan/lihat', $this->data);
	}

	public function tambah(){

		$this->data['title'] = 'Tambah Pelanggan';

		$this->load->view('pelanggan/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'no_ktp'=> $this->input->post('no_ktp'),
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),
			'alamat_pelanggan' => $this->input->post('alamat_pelanggan'),
			'no_tlp' => $this->input->post('no_tlp'),
			'no_polisi' => $this->input->post('no_polisi'),
			'no_rangka' => $this->input->post('no_rangka'),
			'kode_model' => $this->input->post('kode_model'),
			'tahun' => $this->input->post('tahun'),
			'model' => $this->input->post('model'),
		];

		if($this->m_pelanggan->tambah($data)){
			$this->session->set_flashdata('success', 'Data Pelanggan <strong>Berhasil</strong> Ditambahkan!');
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('error', 'Data Pelanggan <strong>Gagal</strong> Ditambahkan!');
			redirect('pelanggan');
		}
	}

	public function ubah($kode_pelanggan){

		$this->data['title'] = 'Ubah Pelanggan';
		$this->data['pelanggan'] = $this->m_pelanggan->lihat_id($kode_pelanggan);

		$this->load->view('pelanggan/ubah', $this->data);
	}

	public function proses_ubah($kode_pelanggan){

		$data = [
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),
			'alamat_pelanggan' => $this->input->post('alamat_pelanggan'),
			'no_tlp' => $this->input->post('no_tlp'),
			'no_polisi' => $this->input->post('no_polisi'),
			'no_rangka' => $this->input->post('no_rangka'),
			'kode_model' => $this->input->post('kode_model'),
			'tahun' => $this->input->post('tahun'),
			'model' => $this->input->post('model'),
		];

		if($this->m_pelanggan->ubah($data, $kode_pelanggan)){
			$this->session->set_flashdata('success', 'Data Pelanggan <strong>Berhasil</strong> Diubah!');
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('error', 'Data Pelanggan <strong>Gagal</strong> Diubah!');
			redirect('pelanggan');
		}
	}

	public function hapus($kode_pelanggan){
		
		if($this->m_pelanggan->hapus($kode_pelanggan)){
			$this->session->set_flashdata('success', 'Data Pelanggan <strong>Berhasil</strong> Dihapus!');
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('error', 'Data Pelanggan <strong>Gagal</strong> Dihapus!');
			redirect('pelanggan');
		}
	}

	public function detail($kode_pelanggan){
		$this->data['title'] = 'Detail Pelanggan';
		$this->data['pelanggan'] = $this->m_pelanggan->lihat_detail($kode_pelanggan)->row();
		$this->data['no'] = 1;

		$this->load->view('pelanggan/detail', $this->data);
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_customer'] = $this->m_pelanggan->lihat();
		$this->data['title'] = 'Laporan Data Pelanggan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pelanggan/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pelanggan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}