<?php

class M_forcesting extends CI_Model {
	protected $_table = 'forcasting';

	public function lihat(){
		return	$this->db->query("SELECT forcasting.kode_part, part.nama_part FROM forcasting JOIN part ON forcasting.kode_part=part.kode_part GROUP BY kode_part");
	}


	public function detail($kode_part) {
		 return $this->db->query("SELECT * FROM forcasting WHERE kode_part='$kode_part'");
	}

	// query grafik forcasting
	public function grafik($kode_part) {
		 return $this->db->query("SELECT * FROM forcasting WHERE kode_part='$kode_part'");
	}

	public function namagrafik($kode_part) {
		 return $this->db->query("SELECT part.nama_part, part.kode_part FROM forcasting JOIN part ON forcasting.kode_part=part.kode_part WHERE forcasting.kode_part='$kode_part'");
	}

}