<?php

class M_detail_masuk extends CI_Model {
	protected $_table = 'rincian_transaksi_masuk';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_detail($kode_rincian_masuk){
		return $this->db->get_where($this->_table, ['kode_rincian_masuk' => $kode_rincian_masuk])->result();
	}

	public function lihat_no_terima($kode_rincian_masuk){
		return $this->db->get_where($this->_table, ['kode_rincian_masuk' => $kode_rincian_masuk])->result();
	}

	public function hapus($kode_rincian_masuk){
		return $this->db->delete($this->_table, ['kode_rincian_masuk' => $kode_rincian_masuk]);
	}

	// perbaiki query detail
	public function rincian_transaksi($kode_transaksi_masuk) {
		return $this->db->query("SELECT part.kode_part,nama_part,harga_beli,satuan, rincian_transaksi_masuk.qty_masuk,kode_transaksi_masuk FROM part JOIN rincian_transaksi_masuk ON part.kode_part=rincian_transaksi_masuk.kode_part WHERE kode_transaksi_masuk ='$kode_transaksi_masuk' ");
	}
}