<?php

class M_pelanggan extends CI_Model{
	protected $_table = 'pelanggan';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_cst(){
		$query = $this->db->select('kode_pelanggan,nama_pelanggan,no_polisi');
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_id($kode_pelanggan){
		$query = $this->db->get_where($this->_table, ['kode_pelanggan' => $kode_pelanggan]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $kode_pelanggan){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_pelanggan' => $kode_pelanggan]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function lihat_detail($kode_pelanggan){
		return $this->db->query("SELECT * FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'");
	}

	public function hapus($kode_pelanggan){
		return $this->db->delete($this->_table, ['kode_pelanggan' => $kode_pelanggan]);
	}
	
	public function lihat_nama_pelanggan($kode_pelanggan){
		$query = $this->db->select('*');
		$query = $this->db->where(['kode_pelanggan' => $kode_pelanggan]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}
}