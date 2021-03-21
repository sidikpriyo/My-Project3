<?php

class Forcesting extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata['status'] != 'SPAREPART' && $this->session->userdata['status'] != 'KABENG' && $this->session->userdata['status'] != 'OUTLET') {
			redirect('Auth');
		}
		$this->data['aktif'] = 'forcesting';
		$this->load->model('M_forcesting', 'm_forcesting');
		$this->load->model('M_Transaksikeluar', 'm_transaksikeluar');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
	}

	public function index() {
		$this->data['title'] = 'Forcesting';
		$this->data['forcasting'] = $this->m_forcesting->lihat()->result();
		$this->data['no'] = 1;
		$this->load->view('forcesting/lihat', $this->data);
	}

	public function detail($kode_part) {
		$this->data['title'] = 'Detail Forcesting';
		$this->data['rincian_forcasting'] = $this->m_forcesting->detail($kode_part)->result();
		$this->data['no'] = 1;

		$this->load->view('forcesting/detail', $this->data);
	}


	public function chart($kode_part) {
		$this->data['pt'] = $this->m_forcesting->namagrafik($kode_part)->row();
		$data_tahun_cari = $this->input->post('tahun_cari');
		$tahunx = $data_tahun_cari == '-pilih-' ? date('Y') : $data_tahun_cari;
		$time1 = date("$tahunx-01-01");
		$time2 = date("$tahunx-12-31");
		$year = new DatePeriod(
			new DateTime($time1),
			new DateInterval('P1M'),
			new DateTime($time2)
		);
		// mencari bulan dalam satu tahun
		$month = [];
		foreach ($year as $key => $value) {
			$month[] = $value->format('Y-m-d');
		}

		$this->data['tmonth'] = $month;

		$this->data['title'] = 'Chart Forecesting';
		$this->data['forcasting'] = $this->m_forcesting->detail($kode_part)->result();
// menampilkan data forcasting,absolut sesuai data part yang dipilih
		$x = $this->db->query("SELECT *,DATE_FORMAT(bulan,'%Y-%m') AS datex, if(forcasting!=0,round(abs(qty-forcasting),5),0) AS atfc FROM forcasting WHERE kode_part='$kode_part' AND bulan between '" . $time1 . "' and '" . $time2 . "' GROUP BY YEAR(bulan),MONTH(bulan)")->result();
		$this->data['detail'] = $x;

		$xx = [];
		// menampilkan data pada grafik sesuai dengan bulan & tahun yang ada
		foreach ($x as $key => $value) {
			$d = date('Y-m', strtotime($value->bulan));
			$xx[$d] = $value;
		}
		$months = [];
		for ($i = 1; $i <= 12; $i++) {
			$bln = $tahunx . '-' . ($i <= 9 ? "0" : "") . $i;
			foreach (!isset($xx) || $xx == null ? [] : $xx as $key => $value) {
				$months[$bln]['qty'] = @$xx[$bln]->qty;
				$months[$bln]['forcasting'] = @$xx[$bln]->forcasting;
			}
		}

		$this->data['grap'] = $months;
		$this->data['tahun'] = $this->db->query("SELECT  DATE_FORMAT(bulan, '%Y') as th FROM forcasting group by year(bulan)")->result();


		$maksimal= $this->db->query("SELECT MAX(qty) as totalmax FROM forcasting WHERE kode_part='$kode_part'")->result();
		// nilai max
		$a=@$maksimal[0]->totalmax;
		$max=(int)$a;
		// jumlah penjualan
		$jml_act = $this->db->query("SELECT SUM(qty) AS totalact FROM forcasting WHERE kode_part='$kode_part'")->result();
		$n = @$jml_act[0]->totalact;
		$nilai_act = (int) $n;
		// ambil row
		$jml_row = $this->db->query("SELECT transaksi_keluar.tgl_transaksi_keluar FROM rincian_transaksi_keluar JOIN transaksi_keluar ON rincian_transaksi_keluar.kode_transaksi_keluar=transaksi_keluar.kode_transaksi_keluar WHERE kode_part='$kode_part' GROUP BY DATE_FORMAT(tgl_transaksi_keluar,'%Y-%m')")->num_rows();
		// hitung rata-rata penjualan
		$avg=$nilai_act/$jml_row;
		// hitung safety stok
		$safety=($max-$avg)/12;
		$this->data['safety'] = $safety;

		// menampilkan data mad & mape
		$this->data['mad_mape'] = $this->db->query("SELECT *,round(sum(atfc)/count(aa.id),5) AS mad,round(sum(atfc)/sum(aa.qty),3)*100 AS mape FROM (SELECT *,DATE_FORMAT(bulan,'%Y-%m') AS datex, if(forcasting!=0,abs(qty-forcasting),0) AS atfc FROM forcasting WHERE kode_part='$kode_part' and qty>0 GROUP BY YEAR(bulan),MONTH(bulan) ORDER BY id ASC LIMIT 3,1000) AS aa")->result();

		$this->load->view('forcesting/chart', $this->data);
	}

		

}