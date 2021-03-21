<tr class="row-keranjang">
	
		<input type="hidden" name="kode_rincian_keluar_hidden[]" value="">
	
		<input type="hidden" name="kode_transaksi_keluar_hidden[]" value="">
	
	<td class="kode_part">
		<?= $this->input->post('kode_part') ?>
		<input type="hidden" name="kode_part_hidden[]" value="<?= $this->input->post('kode_part') ?>">
	</td>
	<td class="nama_part">
		<?= $this->input->post('nama_part') ?>
		<input type="hidden" name="nama_part_hidden[]" value="<?= $this->input->post('nama_part') ?>">
	</td>
	<td class="qty_keluar">
		<?= $this->input->post('qty_keluar') ?>
		<input type="hidden" name="qty_keluar_hidden[]" value="<?= $this->input->post('qty_keluar') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-kode-part="<?= $this->input->post('kode_part') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>