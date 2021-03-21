<?php

class M_transaksikeluar extends CI_Model {
	protected $_table = 'transaksi_keluar';

	public function lihat(){
	
	return $this->db->query("SELECT transaksi_keluar.kode_transaksi_keluar,tgl_transaksi_keluar , pelanggan.nama_pelanggan, pelanggan.no_polisi, pelanggan.kode_pelanggan, karyawan.nama_karyawan, part.nama_part,harga,rincian_transaksi_keluar.qty_keluar, SUM(part.harga*rincian_transaksi_keluar.qty_keluar) AS jumlah FROM rincian_transaksi_keluar LEFT JOIN transaksi_keluar ON transaksi_keluar.kode_transaksi_keluar = rincian_transaksi_keluar.kode_transaksi_keluar LEFT JOIN pelanggan ON pelanggan.kode_pelanggan=transaksi_keluar.kode_pelanggan LEFT JOIN karyawan ON karyawan.kode_karyawan=transaksi_keluar.kode_karyawan LEFT JOIN part ON rincian_transaksi_keluar.kode_part=part.kode_part GROUP BY kode_transaksi_keluar order by tgl_transaksi_keluar asc");
	}

	public function jml_transaksi_keluar(){
		return $this->db->query("SELECT SUM(part.harga*rincian_transaksi_keluar.qty_keluar) AS jumlah FROM rincian_transaksi_keluar LEFT JOIN transaksi_keluar ON transaksi_keluar.kode_transaksi_keluar = rincian_transaksi_keluar.kode_transaksi_keluar LEFT JOIN part ON rincian_transaksi_keluar.kode_part=part.kode_part");
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_keluar($kode_transaksi_keluar){
		return $this->db->get_where($this->_table, ['kode_transaksi_keluar' => $kode_transaksi_keluar])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($kode_transaksi_keluar){
		return $this->db->delete($this->_table, ['kode_transaksi_keluar' => $kode_transaksi_keluar]);
	}

	public function lihat_keluar($id) {
		return $this->db
		->join('pelanggan','pelanggan.kode_pelanggan = transaksi_keluar.kode_pelanggan')
		->join('karyawan','karyawan.kode_karyawan = transaksi_keluar.kode_karyawan')
		->where('kode_transaksi_keluar', $id)
		->get('transaksi_keluar');
	}

	// cetak laporan periodik
	public function getTahun(){
		$query = $this->db->query('SELECT YEAR(tgl_transaksi_keluar) AS tahun FROM transaksi_keluar GROUP BY YEAR (tgl_transaksi_keluar) ASC');
		return $query->result();
	}

	public function filterbyTanggal($tanggalawal,$tanggalakhir){
		$query = $this->db->query("SELECT transaksi_keluar.kode_transaksi_keluar,tgl_transaksi_keluar, pelanggan.nama_pelanggan, karyawan.nama_karyawan, part.nama_part,harga,rincian_transaksi_keluar.qty_keluar, SUM(part.harga*rincian_transaksi_keluar.qty_keluar) AS jumlah FROM rincian_transaksi_keluar LEFT JOIN transaksi_keluar ON transaksi_keluar.kode_transaksi_keluar = rincian_transaksi_keluar.kode_transaksi_keluar LEFT JOIN pelanggan ON pelanggan.kode_pelanggan=transaksi_keluar.kode_pelanggan LEFT JOIN karyawan ON karyawan.kode_karyawan=transaksi_keluar.kode_karyawan LEFT JOIN part ON rincian_transaksi_keluar.kode_part=part.kode_part WHERE tgl_transaksi_keluar BETWEEN '$tanggalawal' AND '$tanggalakhir' GROUP BY kode_transaksi_keluar");
		return $query->result();
	}

	public function filterbyTanggaljml($tanggalawal,$tanggalakhir){
		$query = $this->db->query("SELECT SUM(part.harga*rincian_transaksi_keluar.qty_keluar) AS jumlah FROM rincian_transaksi_keluar LEFT JOIN transaksi_keluar ON transaksi_keluar.kode_transaksi_keluar = rincian_transaksi_keluar.kode_transaksi_keluar LEFT JOIN part ON rincian_transaksi_keluar.kode_part=part.kode_part WHERE tgl_transaksi_keluar BETWEEN '$tanggalawal' AND '$tanggalakhir'");
		return $query->result();
	}

	public function filterbyBulan($tahun1,$bulanawal,$bulanakhir){

		$query = $this->db->query("SELECT transaksi_keluar.kode_transaksi_keluar,tgl_transaksi_keluar, pelanggan.nama_pelanggan, karyawan.nama_karyawan, part.nama_part,harga,rincian_transaksi_keluar.qty_keluar, SUM(part.harga*rincian_transaksi_keluar.qty_keluar) AS jumlah FROM rincian_transaksi_keluar LEFT JOIN transaksi_keluar ON transaksi_keluar.kode_transaksi_keluar = rincian_transaksi_keluar.kode_transaksi_keluar LEFT JOIN pelanggan ON pelanggan.kode_pelanggan=transaksi_keluar.kode_pelanggan LEFT JOIN karyawan ON karyawan.kode_karyawan=transaksi_keluar.kode_karyawan LEFT JOIN part ON rincian_transaksi_keluar.kode_part=part.kode_part WHERE YEAR(tgl_transaksi_keluar) = '$tahun1' and MONTH(tgl_transaksi_keluar) BETWEEN '$bulanawal' AND '$bulanakhir' GROUP BY kode_transaksi_keluar");
		return $query->result();
	}

	public function filterbyBulanjml($tahun1,$bulanawal,$bulanakhir){
		$query = $this->db->query("SELECT SUM(part.harga*rincian_transaksi_keluar.qty_keluar) AS jumlah FROM rincian_transaksi_keluar LEFT JOIN transaksi_keluar ON transaksi_keluar.kode_transaksi_keluar = rincian_transaksi_keluar.kode_transaksi_keluar LEFT JOIN part ON rincian_transaksi_keluar.kode_part=part.kode_part WHERE YEAR(tgl_transaksi_keluar) = '$tahun1' and MONTH(tgl_transaksi_keluar) BETWEEN '$bulanawal' AND '$bulanakhir'");
		return $query->result();
	}

	public function filterbyTahun($tahun2){
		$query = $this->db->query("SELECT transaksi_keluar.kode_transaksi_keluar,tgl_transaksi_keluar, pelanggan.nama_pelanggan, karyawan.nama_karyawan, part.nama_part,harga,rincian_transaksi_keluar.qty_keluar, SUM(part.harga*rincian_transaksi_keluar.qty_keluar) AS jumlah FROM rincian_transaksi_keluar LEFT JOIN transaksi_keluar ON transaksi_keluar.kode_transaksi_keluar = rincian_transaksi_keluar.kode_transaksi_keluar LEFT JOIN pelanggan ON pelanggan.kode_pelanggan=transaksi_keluar.kode_pelanggan LEFT JOIN karyawan ON karyawan.kode_karyawan=transaksi_keluar.kode_karyawan LEFT JOIN part ON rincian_transaksi_keluar.kode_part=part.kode_part where YEAR(tgl_transaksi_keluar) = '$tahun2' GROUP BY kode_transaksi_keluar");
		return $query->result();
	}
	public function filterbyTahunjml($tahun2){
		$query = $this->db->query("SELECT SUM(part.harga*rincian_transaksi_keluar.qty_keluar) AS jumlah FROM rincian_transaksi_keluar LEFT JOIN transaksi_keluar ON transaksi_keluar.kode_transaksi_keluar = rincian_transaksi_keluar.kode_transaksi_keluar LEFT JOIN part ON rincian_transaksi_keluar.kode_part=part.kode_part where YEAR(tgl_transaksi_keluar) = '$tahun2'");
		return $query->result();

	}
}