<?php

class M_part extends CI_Model{
	protected $_table = 'part';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok(){
		$query = $this->db->get_where($this->_table, 'qty >=0');
		return $query->result();
	}

	public function lihat_id($kode_part){
		$query = $this->db->get_where($this->_table, ['kode_part' => $kode_part]);
		return $query->row();
	}


	public function lihat_nama_barang($kode_part){
		$query = $this->db->select('*');
		$query = $this->db->where(['kode_part' => $kode_part]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}
	// Menambah sparepart pada transaksi masuk
	public function plus_stok($qty, $nama_part){
		$query = $this->db->set('qty', 'qty+' . $qty, false);
		$query = $this->db->where('kode_part', $nama_part);
		$query = $this->db->update($this->_table);
		return $query;
	}
	//mengurangi sparepart pada transaksi keluar
	public function min_stok($qty, $kode_part){
		$query = $this->db->set('qty', 'qty-' . $qty, false);
		$query = $this->db->where('kode_part', $kode_part);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $kode_part){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_part' => $kode_part]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_part){
		return $this->db->delete($this->_table, ['kode_part' => $kode_part]);
	}
}