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
			<div id="content" data-url="<?= base_url('pelanggan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('pelanggan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-10">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('pelanggan/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-4">
											<label for="kode_pelanggan"><strong>Kode Pelanggan</strong></label>
											<input type="text" name="kode_pelanggan" placeholder="Masukkan Kode Pelanggan" autocomplete="off"  class="form-control" required value="<?= mt_rand(0, 99999) ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-8">
											<label for="no_ktp"><strong>Nomor KTP</strong></label>
											<input type="number" name="no_ktp" placeholder="Masukkan No KTP Pelanggan" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="nama_pelanggan"><strong>Nama Pelanggan</strong></label>
											<input type="text" name="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="no_tlp"><strong>Nomor Telepon</strong></label>
											<input type="number" name="no_tlp" placeholder="Masukkan No Telepon" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-group">
										<label for="alamat_pelanggan"><strong>Alamat Pelanggan</strong></label>
										<textarea name="alamat_pelanggan" id="alamat_pelanggan" style="resize: none;" class="form-control" placeholder="Masukkan Alamat Pelanggan"></textarea>
									</div>
									<hr>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="no_polisi"><strong>Nomor Polisi Kendaraan</strong></label>
											<input type="text" name="no_polisi" placeholder="Masukkan No Polisi" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="no_rangka"><strong>Nomor Rangka Kendaraan</strong></label>
											<input type="text" name="no_rangka" placeholder="Masukkan No Rangka" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<hr>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_model"><strong>Kode Model</strong></label>
											<input type="text" name="kode_model" placeholder="Masukkan kode Model" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="model"><strong>Model</strong></label>
											<input type="text" name="model" placeholder="Masukkan model Kendaraan" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="tahun"><strong>Tahun Perakitan</strong></label>
											<input type="text" name="tahun" placeholder="Masukan Tahun Perakitan" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<hr>
									</div>
								</div>
									
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