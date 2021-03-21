<?php

class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();

		if ($this->session->userdata['status'] != 'SPAREPART' && $this->session->userdata['status'] != 'KABENG' && $this->session->userdata['status'] != 'OUTLET') {
			redirect('Auth');
		}
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_part', 'm_part');
		$this->load->model('M_pelanggan', 'm_pelanggan');
		$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_Transaksikeluar', 'm_transaksikeluar');
		$this->load->model('M_Transaksimasuk', 'm_transaksimasuk');
		$this->load->model('M_pengguna', 'm_pengguna');
		
	}

	public function index(){
		$this->data['title'] = 'Halaman Dashboard';
		$this->data['jumlah_barang'] = $this->m_part->jumlah();
		$this->data['jumlah_customer'] = $this->m_pelanggan->jumlah();
		$this->data['jumlah_supplier'] = $this->m_supplier->jumlah();
		$this->data['jumlah_petugas'] = $this->m_pengguna->jumlah();
		$this->data['jumlah_pengeluaran'] = $this->m_transaksikeluar->jumlah();
		$this->data['jumlah_penerimaan'] = $this->m_transaksimasuk->jumlah();
		$this->load->view('dashboard', $this->data);
	}
}