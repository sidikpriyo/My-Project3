<?php

use Dompdf\Dompdf;

class Part extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata['status'] != 'SPAREPART' && $this->session->userdata['status'] != 'KABENG' && $this->session->userdata['status'] != 'OUTLET') {
			redirect('Auth');
		}
		$this->data['aktif'] = 'part';
		$this->load->model('M_part', 'm_part');
	}

	public function index(){
		$this->data['title'] = 'Data Sparepart';
		$this->data['all_part'] = $this->m_part->lihat();
		$this->data['no'] = 1;

		$this->load->view('part/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Sparepart';
		$this->load->view('part/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode_part' => $this->input->post('kode_part'),
			'nama_part' => $this->input->post('nama_part'),
			'qty' => $this->input->post('qty'),
			'harga' => $this->input->post('harga'),
			'harga_beli' => $this->input->post('harga_beli'),
			'satuan' => $this->input->post('satuan'),
		];

		if($this->m_part->tambah($data)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
			redirect('part');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
			redirect('part');
		}
	}

	public function ubah($kode_part){
		$this->data['title'] = 'Edit Part';
		$this->data['part'] = $this->m_part->lihat_id($kode_part);

		$this->load->view('part/ubah', $this->data);
	}

	public function proses_ubah($kode_part){
		$data = [
			'kode_part' => $this->input->post('kode_part'),
			'nama_part' => $this->input->post('nama_part'),
			'harga' => $this->input->post('harga'),
			'harga_beli' => $this->input->post('harga_beli'),
			'qty' => $this->input->post('qty'),
			'satuan' => $this->input->post('satuan')
		];

		if($this->m_part->ubah($data, $kode_part)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('part');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			redirect('part');
		}
	}

	public function hapus($kode_part){
		if($this->m_part->hapus($kode_part)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			redirect('part');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			redirect('part');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_barang'] = $this->m_part->lihat();
		$this->data['title'] = 'Laporan Data Barang';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('part/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Barang Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}