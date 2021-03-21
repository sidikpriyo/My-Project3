<?php

class M_Transaksimasuk extends CI_Model {
	protected $_table = 'transaksi_masuk';

	public function lihat(){
		return $this->db->query("SELECT transaksi_masuk.kode_transaksi_masuk,tgl_transaksi_masuk, supplier.kode_supplier,nama_supplier, karyawan.nama_karyawan, part.nama_part,harga_beli,rincian_transaksi_masuk.qty_masuk, SUM(part.harga_beli*rincian_transaksi_masuk.qty_masuk) AS jumlah FROM rincian_transaksi_masuk LEFT JOIN transaksi_masuk ON transaksi_masuk.kode_transaksi_masuk = rincian_transaksi_masuk.kode_transaksi_masuk LEFT JOIN supplier ON supplier.kode_supplier=transaksi_masuk.kode_supplier LEFT JOIN karyawan ON karyawan.kode_karyawan=transaksi_masuk.kode_karyawan LEFT JOIN part ON rincian_transaksi_masuk.kode_part=part.kode_part GROUP BY kode_transaksi_masuk");
	}

	public function jml_transaksi_masuk(){
		return $this->db->query("SELECT SUM(part.harga_beli*rincian_transaksi_masuk.qty_masuk) AS jumlah FROM rincian_transaksi_masuk LEFT JOIN transaksi_masuk ON transaksi_masuk.kode_transaksi_masuk = rincian_transaksi_masuk.kode_transaksi_masuk LEFT JOIN part ON rincian_transaksi_masuk.kode_part=part.kode_part");
	}

	public function lihat_penerima($kode_transaksi_masuk) {
		return $this->db
		->join('supplier','supplier.kode_supplier = transaksi_masuk.kode_supplier')
		->join('karyawan','karyawan.kode_karyawan = transaksi_masuk.kode_karyawan')
		->where('kode_transaksi_masuk', $kode_transaksi_masuk)
		->get('transaksi_masuk');
	} 

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_terima($kode_transaksi_masuk){
		return $this->db->get_where($this->_table, ['kode_transaksi_masuk' => $kode_transaksi_masuk])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	// membuat laporan periodik
	public function getTahun(){
		$query = $this->db->query('SELECT YEAR(tgl_transaksi_masuk) AS tahun FROM transaksi_masuk GROUP BY YEAR (tgl_transaksi_masuk) ASC');
		return $query->result();
	}

	public function filterbyTanggal($tanggalawal,$tanggalakhir){

		$query = $this->db->query("SELECT transaksi_masuk.kode_transaksi_masuk,tgl_transaksi_masuk, supplier.kode_supplier,nama_supplier, karyawan.nama_karyawan, part.nama_part,harga_beli,rincian_transaksi_masuk.qty_masuk, SUM(part.harga_beli*rincian_transaksi_masuk.qty_masuk) AS jumlah FROM rincian_transaksi_masuk LEFT JOIN transaksi_masuk ON transaksi_masuk.kode_transaksi_masuk = rincian_transaksi_masuk.kode_transaksi_masuk LEFT JOIN supplier ON supplier.kode_supplier=transaksi_masuk.kode_supplier LEFT JOIN karyawan ON karyawan.kode_karyawan=transaksi_masuk.kode_karyawan LEFT JOIN part ON rincian_transaksi_masuk.kode_part=part.kode_part WHERE tgl_transaksi_masuk BETWEEN '$tanggalawal' AND '$tanggalakhir' GROUP BY kode_transaksi_masuk");
		return $query->result();

	}

	public function filterbyTanggaljml($tanggalawal,$tanggalakhir){
		$query = $this->db->query("SELECT SUM(part.harga_beli*rincian_transaksi_masuk.qty_masuk) AS jumlah FROM rincian_transaksi_masuk LEFT JOIN transaksi_masuk ON transaksi_masuk.kode_transaksi_masuk = rincian_transaksi_masuk.kode_transaksi_masuk LEFT JOIN part ON rincian_transaksi_masuk.kode_part=part.kode_part WHERE tgl_transaksi_masuk BETWEEN '$tanggalawal' AND '$tanggalakhir'");
		return $query->result();

	}

	public function filterbyBulan($tahun1,$bulanawal,$bulanakhir){

		$query = $this->db->query("SELECT transaksi_masuk.kode_transaksi_masuk,tgl_transaksi_masuk, supplier.kode_supplier,nama_supplier, karyawan.nama_karyawan, part.nama_part,harga_beli,rincian_transaksi_masuk.qty_masuk, SUM(part.harga_beli*rincian_transaksi_masuk.qty_masuk) AS jumlah FROM rincian_transaksi_masuk LEFT JOIN transaksi_masuk ON transaksi_masuk.kode_transaksi_masuk = rincian_transaksi_masuk.kode_transaksi_masuk LEFT JOIN supplier ON supplier.kode_supplier=transaksi_masuk.kode_supplier LEFT JOIN karyawan ON karyawan.kode_karyawan=transaksi_masuk.kode_karyawan LEFT JOIN part ON rincian_transaksi_masuk.kode_part=part.kode_part WHERE YEAR(tgl_transaksi_masuk) = '$tahun1' and MONTH(tgl_transaksi_masuk) BETWEEN '$bulanawal' AND '$bulanakhir' GROUP BY kode_transaksi_masuk");
		return $query->result();
	}

	public function filterbyBulanjml($tahun1,$bulanawal,$bulanakhir){
		$query = $this->db->query("SELECT SUM(part.harga_beli*rincian_transaksi_masuk.qty_masuk) AS jumlah FROM rincian_transaksi_masuk LEFT JOIN transaksi_masuk ON transaksi_masuk.kode_transaksi_masuk = rincian_transaksi_masuk.kode_transaksi_masuk LEFT JOIN part ON rincian_transaksi_masuk.kode_part=part.kode_part WHERE YEAR(tgl_transaksi_masuk) = '$tahun1' and MONTH(tgl_transaksi_masuk) BETWEEN '$bulanawal' AND '$bulanakhir'");
		return $query->result();

	}

	public function filterbyTahun($tahun2){
		$query = $this->db->query("SELECT transaksi_masuk.kode_transaksi_masuk,tgl_transaksi_masuk, supplier.kode_supplier,nama_supplier, karyawan.nama_karyawan, part.nama_part,harga_beli,rincian_transaksi_masuk.qty_masuk, SUM(part.harga_beli*rincian_transaksi_masuk.qty_masuk) AS jumlah FROM rincian_transaksi_masuk LEFT JOIN transaksi_masuk ON transaksi_masuk.kode_transaksi_masuk = rincian_transaksi_masuk.kode_transaksi_masuk LEFT JOIN supplier ON supplier.kode_supplier=transaksi_masuk.kode_supplier LEFT JOIN karyawan ON karyawan.kode_karyawan=transaksi_masuk.kode_karyawan LEFT JOIN part ON rincian_transaksi_masuk.kode_part=part.kode_part where YEAR(tgl_transaksi_masuk) = '$tahun2' GROUP BY kode_transaksi_masuk");
		return $query->result();
	}
	public function filterbyTahunjml($tahun2){
		$query = $this->db->query("SELECT SUM(part.harga_beli*rincian_transaksi_masuk.qty_masuk) AS jumlah FROM rincian_transaksi_masuk LEFT JOIN transaksi_masuk ON transaksi_masuk.kode_transaksi_masuk = rincian_transaksi_masuk.kode_transaksi_masuk LEFT JOIN part ON rincian_transaksi_masuk.kode_part=part.kode_part where YEAR(tgl_transaksi_masuk) = '$tahun2'");
		return $query->result();

	}


}