<?php

class M_detail_keluar extends CI_Model {
	protected $_table = 'rincian_transaksi_keluar';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_keluar($kode_rincian_keluar){
		return $this->db->get_where($this->_table, ['kode_rincian_keluar' => $kode_rincian_keluar])->result();
	}

	public function hapus($kode_rincian_keluar){
		return $this->db->delete($this->_table, ['kode_rincian_keluar' => $kode_rincian_keluar]);
	}

	public function get_rincian_transaksi_keluar_by_id($id) {
		return $this->db
		->join('part','part.kode_part = rincian_transaksi_keluar.kode_part')
		->where('kode_transaksi_keluar', $id)
		->get('rincian_transaksi_keluar');
	}
}