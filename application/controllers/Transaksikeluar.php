<?php

use Dompdf\Dompdf;

class Transaksikeluar extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata['status'] != 'SPAREPART' && $this->session->userdata['status'] != 'KABENG' && $this->session->userdata['status'] != 'OUTLET') {
			redirect('Auth');
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->data['aktif'] = 'pengeluaran';
		$this->load->model('M_part', 'm_part');
		$this->load->model('M_pelanggan', 'm_pelanggan');
		$this->load->model('M_Transaksikeluar', 'm_transaksikeluar');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
	}

	public function index() {
		$this->data['title'] = 'Transaksi Keluar';
		$this->data['all_pengeluaran'] = $this->m_transaksikeluar->lihat()->result();
		$this->data['jumlah_tr'] = $this->m_transaksikeluar->jml_transaksi_keluar()->result();
		$this->data['no'] = 1;

		$this->load->view('transaksikeluar/lihat', $this->data);
	}

	public function tambah() {
		$this->data['title'] = 'Tambah Transaksi Keluar';
		$this->data['all_barang'] = $this->m_part->lihat_stok();
		$this->data['all_customer'] = $this->m_pelanggan->lihat_cst();

		$this->load->view('transaksikeluar/tambah', $this->data);
	}

	public function proses_tambah() {
		$jumlah_barang_keluar = count($this->input->post('kode_part_hidden'));
// post input transaksikeluar
		$data_keluar = [
			'kode_transaksi_keluar' => $this->input->post('kode_transaksi_keluar'),
			'tgl_transaksi_keluar' => date('Y-m-d', time()),
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'kode_karyawan' => $this->input->post('kode_karyawan'),
		];
//perlu array data detail keluar
		$data_detail_keluar = [];

		for ($i = 0; $i < $jumlah_barang_keluar; $i++) {
			array_push($data_detail_keluar, ['kode_rincian_keluar' => $this->input->post('kode_rincian_keluar')]);
			$data_detail_keluar[$i]['kode_part'] = $this->input->post('kode_part_hidden')[$i];
			$data_detail_keluar[$i]['qty_keluar'] = $this->input->post('qty_keluar_hidden')[$i];
			$data_detail_keluar[$i]['kode_transaksi_keluar'] = $this->input->post('kode_transaksi_keluar');
		}
//mulai perhitungan forecasting
		$bulan = date('m');
		$tahun = date('Y');
		// mengatasi kondisi bulan ini desember atau tidak
		if (date('m') == 12) {
			$bulan1 = '01';
			$tahun1 = date('Y', strtotime('+1 year'));
		} else {
			$bulan1 = date('m', strtotime('+1 month'));
			$tahun1 = date('Y');
		}
//ambil data detail keluar pada tabel rincian keluar pada database
		foreach ($data_detail_keluar as $key => $value) {
// cek apakah ada data pada bulan,tahun tahun saat ini dan kode part dengan yang diinput
			$check = $this->db->query("select * from forcasting where MONTH(bulan)='" . $bulan . "' and year(bulan)='" . $tahun . "' and kode_part='" . $value['kode_part'] . "'")->row();
			//hitung jumlah kode part yang sama dengan kode part yang diinput
			$check2 = $this->db->query("select count(*) as cek2 from forcasting where kode_part='" . $value['kode_part'] . "'")->row();
			//cek apakah ada data pada bulan depan dan kode part dengan data yang diinput
			$check3 = $this->db->query("select * from forcasting where MONTH(bulan)='" . $bulan1 . "' and year(bulan)='" . $tahun1 . "' and kode_part='" . $value['kode_part'] . "'")->row();
//bulan saat ini
			$today = date('m');
			//bulan kemarin
			$month0 = date('m', strtotime('-1 month'));
			// 2 bulan sebelumnya
			$month1 = date('m', strtotime('-2 month'));
			// 3 bulan sebelumnya
			$month2 = date('m', strtotime('-3 month'));
// tahun sebelumnya
			$lastYear = date('Y', strtotime('-1 year'));
// jumlahkan nilai forcating dengan kondisi sesuai inputan
			$query = "SELECT sum(qty) as fct from forcasting where (";
			if ($today == 1) {
				$query .= "
				(year(bulan)= $lastYear AND MONTH(bulan)=$month0) OR
				(year(bulan)= $lastYear AND MONTH(bulan)=$month1) OR
				(year(bulan)= $lastYear AND MONTH(bulan)=$month2)";
			} else if ($today == 2) {
				$query .= "
				(year(bulan)= year(now()) AND MONTH(bulan)=$month0) OR
				(year(bulan)= $lastYear AND MONTH(bulan)=$month1) OR
				(year(bulan)= $lastYear AND MONTH(bulan)=$month2)";
			} else if ($today == 3) {
				$query .= "
				(year(bulan)= year(now()) AND MONTH(bulan)=$month0) OR
				(year(bulan)= year(now()) AND MONTH(bulan)=$month1) OR
				(year(bulan)= $lastYear AND MONTH(bulan)=$month2)";
			} else {
				$query .= "year(bulan)= year(now())
			 	and month(bulan)
			 	in ($month0,$month1,$month2)";
			}

			$query .= ") AND kode_part = '" . $value['kode_part'] . "'";
			$f = $this->db->query($query)->row();

// cek apakah ada data pada bulan,tahun tahun saat ini dan kode part dengan yang diinput			
			if ($check) {
				$new_qty = $check->qty + $value['qty_keluar'];
				// jika hasil cek2 kurang dari 4 maka buat forcasting awal dengan nilai 0 jika 4 atau lebih maka hitung forcasting
				if ($check2->cek2 < 4) {
					$new_forcasting = 0;
				} else {
					$new_forcasting = $f->fct / 3;
				}
				// update tabel forcasting sesuai dengan inputan dan kondisi yang sesuai
				$this->db->update('forcasting', ['qty' => $new_qty, 'forcasting' => $new_forcasting], ['id' => $check->id]);
				// berfungsi mengatasi ganti tahun
				$query2 = "SELECT sum(qty) as fct from forcasting where (";
				if ($today == 1) {
					$query2 .= "
					(year(bulan)= year(now()) AND MONTH(bulan)=$today) OR
					(year(bulan)= $lastYear AND MONTH(bulan)=$month0) OR
					(year(bulan)= $lastYear AND MONTH(bulan)=$month1)";
				} else if ($today == 2) {
					$query2 .= "
					(year(bulan)= year(now()) AND MONTH(bulan)=$today) OR
					(year(bulan)= year(now()) AND MONTH(bulan)=$month0) OR
					(year(bulan)= $lastYear AND MONTH(bulan)=$month1)";
				} else {
					$query2 .= "year(bulan)= year(now())
				 	and month(bulan)
				 	in ($today,$month0,$month1)";
				}

				$query2 .= ") AND kode_part = '" . $value['kode_part'] . "'";
				$f2 = $this->db->query($query2)->row();
				$new_forcasting2 = $f2->fct / 3;
				// jika data pada tabel forcasting belum ada kodepart & data bulan depan maka buat data baru dengan nilai qty awal 0,jika suda ada maka update data yang sudah ada
				if ($check3) {
					$this->db->update('forcasting', ['qty' => 0, 'forcasting' => $new_forcasting2], ['id' => $check3->id]);
				} else {
					$this->db->insert('forcasting', ['qty' => 0, 'forcasting' => $new_forcasting2, 'bulan' => date('Y-m-d', strtotime('+1 month')), 'kode_part' => $value['kode_part']]);
				}
			}

// jika tidak ada data pada bulan,tahun tahun saat ini dan kode part dengan yang diinput
			 else {
				$sync = $this->sync($value['kode_part']);
				$inital_qty = $value['qty_keluar'];
				if ($check2->cek2 < 4) {
					$fct = 0;
				} else {
					$fct = $f->fct / 3;
				}
				$this->db->insert('forcasting', ['qty' => $inital_qty, 'forcasting' => $fct, 'bulan' => date('Y-m-d'), 'kode_part' => $value['kode_part']]);

				$query2 = "SELECT sum(qty) as fct from forcasting where (";
				if ($today == 1) {
					$query2 .= "
					(year(bulan)= year(now()) AND MONTH(bulan)=$today) OR
					(year(bulan)= $lastYear AND MONTH(bulan)=$month0) OR
					(year(bulan)= $lastYear AND MONTH(bulan)=$month1)";
				} else if ($today == 2) {
					$query2 .= "
					(year(bulan)= year(now()) AND MONTH(bulan)=$today) OR
					(year(bulan)= year(now()) AND MONTH(bulan)=$month0) OR
					(year(bulan)= $lastYear AND MONTH(bulan)=$month2)";
				} else {
					$query2 .= "year(bulan)= year(now())
				 	and month(bulan)
				 	in ($today,$month0,$month1)";
				}

				$query2 .= ") AND kode_part = '" . $value['kode_part'] . "'";
				$f2 = $this->db->query($query2)->row();
				$fct = $f2->fct / 3;
				$this->db->insert('forcasting', ['qty' => 0, 'forcasting' => $fct, 'bulan' => date('Y-m-d', strtotime('+1 month')), 'kode_part' => $value['kode_part']]);
			}
		}

		if ($this->m_transaksikeluar->tambah($data_keluar) && $this->m_detail_keluar->tambah($data_detail_keluar)) {
			for ($i = 0; $i < $jumlah_barang_keluar; $i++) {
				//mengurangi stok pada saat trankasi masuk
				$this->m_part->min_stok($data_detail_keluar[$i]['qty_keluar'], $data_detail_keluar[$i]['kode_part']) or die('gagal min stok');
			}

			$this->session->set_flashdata('success', 'Invoice <strong>Pengeluaran</strong> Berhasil Dibuat!');
			redirect('transaksikeluar');
		}

	}

	private function sync($kode_part) {
		$today = date('m');
		$month1 = date('m', strtotime('-1 month'));
		$month2 = date('m', strtotime('-2 month'));

		$lastYear = date('Y', strtotime('-1 year'));

		$query = "SELECT sum(b.qty_keluar) as jml_qty,sum(b.qty_keluar)/3 as fct,a.tgl_transaksi_keluar, b.qty_keluar , b.kode_part from transaksi_keluar a inner join rincian_transaksi_keluar b on b.kode_transaksi_keluar=a.kode_transaksi_keluar where ";
		if ($today == 1) {
			$query .= "
			(year(tgl_transaksi_keluar)= $lastYear AND MONTH(tgl_transaksi_keluar)=$month1) OR
			(year(tgl_transaksi_keluar)= $lastYear AND MONTH(tgl_transaksi_keluar)=$month2) OR
			(year(tgl_transaksi_keluar)= year(now()) AND MONTH(tgl_transaksi_keluar)=$today)";
		} else if ($today == 2) {
			$query .= "
			(year(tgl_transaksi_keluar)= year(now()) AND MONTH(tgl_transaksi_keluar)=$month1) OR
			(year(tgl_transaksi_keluar)= $lastYear AND MONTH(tgl_transaksi_keluar)=$month2) OR
			(year(tgl_transaksi_keluar)= year(now()) AND MONTH(tgl_transaksi_keluar)=$today)";
		} else {
			$query .= "year(tgl_transaksi_keluar)= year(now())
		 	and month(tgl_transaksi_keluar)
		 	in ($today,$month1,$month2)";
		}

		$query .= " AND b.kode_part = '$kode_part' GROUP BY b.kode_part";
		$query = $this->db->query($query);

		return $query->row();
	}

	public function detail($kode_rincian_keluar) {
		$this->data['title'] = 'Detail Pengeluaran';
		$this->data['data_transaksi_keluar'] = $this->m_transaksikeluar->lihat_keluar($kode_rincian_keluar)->row();
		$this->data['rincian_transaksi_keluar'] = $this->m_detail_keluar->get_rincian_transaksi_keluar_by_id($kode_rincian_keluar)->result();
		// $this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($kode_rincian_keluar);
		$this->data['no'] = 1;

		$this->load->view('transaksikeluar/detail', $this->data);
	}

	public function get_all_barang() {
		$data = $this->m_part->lihat_nama_barang($_POST['kode_part']);
		echo json_encode($data);
	}

	// menampilkan pelanggan
	public function get_all_pelanggan() {
		$data = $this->m_pelanggan->lihat_nama_pelanggan($_POST['kode_pelanggan']);
		echo json_encode($data);
	}

	//menyimpan inputan transaksi keluar
	public function keranjang_barang() {
		//$this->data['kode']  = $this->m_transaksikeluar->kode();
		$this->load->view('transaksikeluar/keranjang', $this->data);
	}

	public function export() {

		$dompdf = new Dompdf();
		$this->data['transaksi'] = $this->m_transaksikeluar->lihat()->result();
		$this->data['jumlah_tr'] = $this->m_transaksikeluar->jml_transaksi_keluar()->result();
		$this->data['coba'] = $this->m_part->lihat();
		$this->data['title'] = 'Laporan Data Transaksi Keluar';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('transaksikeluar/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	// laporan by filter
	public function laporan() {
		$this->data['title'] = 'Cetak Laporan Periodik';
		$this->data['tahun'] = $this->m_transaksikeluar->getTahun();
		$this->load->view('transaksikeluar/laporan', $this->data);
	}

	public function filter() {
		$tanggalawal = $this->input->post('tanggalawal');
		$tanggalakhir = $this->input->post('tanggalakhir');
		$tahun1 = $this->input->post('tahun1');
		$bulanawal = $this->input->post('bulanawal');
		$bulanakhir = $this->input->post('bulanakhir');
		$tahun2 = $this->input->post('tahun2');
		$nilaifilter = $this->input->post('nilaifilter');

		if ($nilaifilter == 1) {
			$data['title'] = "Laporan Transaksi Keluar Berdasarkan Tanggal";
			$data['subtitle'] = "Dari Tanggal : " . $tanggalawal . ' Sampai Tanggal: ' . $tanggalakhir;
			$data['datafilter'] = $this->m_transaksikeluar->filterbyTanggal($tanggalawal, $tanggalakhir);
			$data['jumlah_tr'] = $this->m_transaksikeluar->filterbyTanggaljml($tanggalawal, $tanggalakhir);
			$this->load->view('transaksikeluar/print_laporan', $data);

		} elseif ($nilaifilter == 2) {
			$data['title'] = "Laporan Transaksi Keluar Berdasarkan Bulan";
			$data['subtitle'] = "Dari Bulan : " . $bulanawal . ' Sampai Bulan: ' . $bulanakhir . ' Tahun : ' . $tahun1;
			$data['datafilter'] = $this->m_transaksikeluar->filterbyBulan($tahun1, $bulanawal, $bulanakhir);
			$data['jumlah_tr'] = $this->m_transaksikeluar->filterbyBulanjml($tahun1, $bulanawal, $bulanakhir);
			$this->load->view('transaksikeluar/print_laporan', $data);

		} elseif ($nilaifilter == 3) {
			$data['title'] = "Laporan Transaksi Keluar Berdasarkan Tahun";
			$data['subtitle'] = ' Tahun : ' . $tahun2;
			$data['datafilter'] = $this->m_transaksikeluar->filterbyTahun($tahun2);
			$data['jumlah_tr'] = $this->m_transaksikeluar->filterbyTahunjml($tahun2);
			$this->load->view('transaksikeluar/print_laporan', $data);
		}
	}

	public function export_detail($kode_rincian_keluar) {
		$dompdf = new Dompdf();
		$this->data['title'] = 'Detail Pengeluaran';
		$this->data['data_transaksi_keluar'] = $this->m_transaksikeluar->lihat_keluar($kode_rincian_keluar)->row();
		$this->data['rincian_transaksi_keluar'] = $this->m_detail_keluar->get_rincian_transaksi_keluar_by_id($kode_rincian_keluar)->result();
		$this->data['no'] = 1;
		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('transaksikeluar/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}


}