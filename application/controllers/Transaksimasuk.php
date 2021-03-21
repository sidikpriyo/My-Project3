<?php

use Dompdf\Dompdf;

class Transaksimasuk extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata['status'] != 'SPAREPART' && $this->session->userdata['status'] != 'KABENG' && $this->session->userdata['status'] != 'OUTLET') {
			redirect('Auth');
		}
		$this->data['aktif'] = 'transaksimasuk';
		$this->load->model('M_part', 'm_part');
		$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_Transaksimasuk', 'm_transaksimasuk');
		$this->load->model('M_detail_masuk', 'm_detail_masuk');
		$this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index(){
		$this->data['title'] = 'Transaksi Masuk';
		$this->data['all_penerimaan'] = $this->m_transaksimasuk->lihat()->result();
		$this->data['jumlah_tr'] = $this->m_transaksimasuk->jml_transaksi_masuk()->result();
		$this->data['no'] = 1;

		$this->load->view('transaksimasuk/lihat', $this->data);
	}

	public function tambah(){
		//$this->data['kode']  = $this->m_transaksimasuk->kode();	
		$this->data['title'] = 'Tambah Transaksi Masuk';
		$this->data['all_barang'] = $this->m_part->lihat_stok();
		$this->data['all_supplier'] = $this->m_supplier->lihat_spl();
		$this->data['all_karyawan'] = $this->m_pengguna->lihat();

		$this->load->view('transaksimasuk/tambah',$this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_diterima = count($this->input->post('kode_part_hidden'));

		$data_terima = [
			'kode_transaksi_masuk' => $this->input->post('kode_transaksi_masuk'),
			'tgl_transaksi_masuk' => $this->input->post('tgl_transaksi_masuk'),
			'kode_supplier' => $this->input->post('kode_supplier'),
			'kode_karyawan' => $this->input->post('kode_karyawan'),
		];

		$data_detail_terima = [];

		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			array_push($data_detail_terima, ['kode_rincian_masuk' => $this->input->post('kode_rincian_masuk')]);
			
			$data_detail_terima[$i]['kode_part'] = $this->input->post('kode_part_hidden')[$i];
			$data_detail_terima[$i]['qty_masuk'] = $this->input->post('qty_masuk_hidden')[$i];
			// menyamakan inout id
			$data_detail_terima[$i]['kode_transaksi_masuk'] = $this->input->post('kode_transaksi_masuk');
		}
		//menambah stok pada qty sparepart
		if($this->m_transaksimasuk->tambah($data_terima) && $this->m_detail_masuk->tambah($data_detail_terima)){
			for ($i=0; $i < $jumlah_barang_diterima ; $i++) { 
				$this->m_part->plus_stok($data_detail_terima[$i]['qty_masuk'], $data_detail_terima[$i]['kode_part']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
			redirect('transaksimasuk');
		}
	}

	public function detail($kode_transaksi_masuk){
		$this->data['title'] = 'Detail Transaksi Masuk';
		$this->data['penerimaan'] = $this->m_transaksimasuk->lihat_penerima($kode_transaksi_masuk)->row();
		$this->data['rincian_transaksi_masuk'] = $this->m_detail_masuk->rincian_transaksi($kode_transaksi_masuk)->result();
		$this->data['no'] = 1;

		$this->load->view('transaksimasuk/detail', $this->data);
	}

	
	public function get_all_barang(){
		$data = $this->m_part->lihat_nama_barang($_POST['kode_part']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		//$this->data['kode']  = $this->m_transaksimasuk->kode();
		$this->load->view('transaksimasuk/keranjang',$this->data);
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['transaksi'] = $this->m_transaksimasuk->lihat()->result();
		$this->data['jumlah_tr'] = $this->m_transaksimasuk->jml_transaksi_masuk()->result();
		$this->data['coba'] = $this->m_part->lihat();
		$this->data['title'] = 'Laporan Data Transaksi Masuk';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('transaksimasuk/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));

	}


	// laporan by filter
	public function laporan(){
		$this->data['title'] = 'Cetak Laporan Periodik';
		$this->data['tahun'] = $this->m_transaksimasuk->getTahun();
		$this->load->view('transaksimasuk/laporan', $this->data);
	}

	public function filter() {
		$tanggalawal=$this->input->post('tanggalawal');
		$tanggalakhir=$this->input->post('tanggalakhir');
		$tahun1=$this->input->post('tahun1');
		$bulanawal=$this->input->post('bulanawal');
		$bulanakhir=$this->input->post('bulanakhir');
		$tahun2=$this->input->post('tahun2');
		$nilaifilter=$this->input->post('nilaifilter');

		if ($nilaifilter == 1) {
			$data['title'] = "Laporan Transaksi Masuk Berdasarkan Tanggal";
			$data['subtitle'] = "Dari Tanggal : ".$tanggalawal.' Sampai Tanggal: '.$tanggalakhir;
			$data['datafilter'] = $this->m_transaksimasuk->filterbyTanggal($tanggalawal,$tanggalakhir);
			$data['jumlah_tr'] = $this->m_transaksimasuk->filterbyTanggaljml($tanggalawal,$tanggalakhir);
			$this->load->view('transaksimasuk/print_laporan',$data);

		} elseif ($nilaifilter == 2) {
			$data['title'] = "Laporan Transaksi Masuk Berdasarkan Bulan";
			$data['subtitle'] = "Dari Bulan : ".$bulanawal.' Sampai Bulan: '.$bulanakhir.' Tahun : '.$tahun1;
			$data['datafilter'] = $this->m_transaksimasuk->filterbyBulan($tahun1,$bulanawal,$bulanakhir);
			$data['jumlah_tr'] = $this->m_transaksimasuk->filterbyBulanjml($tahun1,$bulanawal,$bulanakhir);
			$this->load->view('transaksimasuk/print_laporan',$data);

		} elseif ($nilaifilter == 3) {
			$data['title'] = "Laporan Transaksi Masuk Berdasarkan Tahun";
			$data['subtitle'] = ' Tahun : '.$tahun2;
			$data['datafilter'] = $this->m_transaksimasuk->filterbyTahun($tahun2);
			$data['jumlah_tr'] = $this->m_transaksimasuk->filterbyTahunjml($tahun2);
			$this->load->view('transaksimasuk/print_laporan',$data);
		}
	}

	public function export_detail($kode_transaksi_masuk){
		$dompdf = new Dompdf();
		$this->data['title'] = 'Detail Transaksi Masuk';
		$this->data['penerimaan'] = $this->m_transaksimasuk->lihat_penerima($kode_transaksi_masuk)->row();
		$this->data['rincian_transaksi_masuk'] = $this->m_detail_masuk->rincian_transaksi($kode_transaksi_masuk)->result();
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		// load detail
		$html = $this->load->view('transaksimasuk/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));

	}

}