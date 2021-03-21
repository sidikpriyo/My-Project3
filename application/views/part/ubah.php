<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('part') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('part') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('part/proses_ubah/' . $part->kode_part) ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_part"><strong>Kode Barang</strong></label>
											<input type="text" name="kode_part" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $part->kode_part ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_part"><strong>Nama Barang</strong></label>
											<input type="text" name="nama_part" placeholder="Masukkan Nama Part" autocomplete="off"  class="form-control" required value="<?= $part->nama_part ?>">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="harga_beli"><strong>Harga Beli</strong></label>
											<input type="number" name="harga_beli" placeholder="Masukkan Harga Beli" autocomplete="off"  class="form-control" required value="<?= $part->harga_beli ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="harga"><strong>Harga Jual</strong></label>
											<input type="number" name="harga" placeholder="Harga" autocomplete="off"  class="form-control" required value="<?= $part->harga ?>">
										</div>
									</div>
										
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="satuan"><strong>Satuan</strong></label>
											<select name="satuan" id="satuan" class="form-control" required>
												<option value="">-- Pilih --</option>
												<option value="PCS" <?= $part->satuan == 'pcs' ? 'selected' : '' ?>>PCS</option>
												<option value="LITER" <?= $part->satuan == 'liter' ? 'selected' : '' ?>>LITER</option>
												<option value="GALON" <?= $part->satuan == 'galon' ? 'selected' : '' ?>>GALON</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="qty"><strong>Jumlah</strong></label>
											<input type="number" name="qty" placeholder="Masukkan qty" autocomplete="off"  class="form-control" required value="<?= $part->qty ?>" >
										</div>
									</div>
									
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
							</div>				
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>