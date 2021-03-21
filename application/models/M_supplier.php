<?php

class M_supplier extends CI_Model{
	protected $_table = 'supplier';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_spl(){
		$query = $this->db->select('nama_supplier,kode_supplier');
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_id($kode_supplier){
		$query = $this->db->get_where($this->_table, ['kode_supplier' => $kode_supplier]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $kode_supplier){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_supplier' => $kode_supplier]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_supplier){
		return $this->db->delete($this->_table, ['kode_supplier' => $kode_supplier]);
	}
}