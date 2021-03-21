<?php

class M_pengguna extends CI_Model{
	protected $_table = 'karyawan';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['kode_karyawan' => $id]);
		return $query->row();
	}

	public function lihat_username($username){
		$query = $this->db->get_where($this->_table, ['username' => $username]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_karyawan' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function detail_karyawan($kode_karyawan){
		return $this->db->query("SELECT * FROM karyawan where kode_karyawan='$kode_karyawan'");
	}

	public function hapus($id){
		return $this->db->delete($this->_table, ['kode_karyawan' => $id]);
	}
}