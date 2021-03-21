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
			<div id="content" data-url="<?= base_url('pengguna') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('pengguna') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-8">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('pengguna/proses_ubah/' . $pengguna->kode_karyawan) ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-3">
											<label for="kode_karyawan"><strong>Kode Karyawan</strong></label>
											<input type="text" name="kode_karyawan" placeholder="Masukkan" autocomplete="off"  class="form-control" required value="<?= $pengguna->kode_karyawan ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-5">
											<label for="nama_karyawan"><strong>Nama Pengguna</strong></label>
											<input type="text" name="nama_karyawan" placeholder="Masukkan Nama Karyawan" autocomplete="off"  class="form-control" required value="<?= $pengguna->nama_karyawan ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="email"><strong>Email</strong></label>
											<input type="text" name="email" placeholder="Masukkan Email" autocomplete="off"  class="form-control" required value="<?= $pengguna->email ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="alamat"><strong>Alamat</strong></label>
										<textarea name="alamat" id="alamat" style="resize: none;" class="form-control" placeholder="Masukkan Alamat"><?= $pengguna->alamat ?></textarea>
									</div>
									<hr>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="no_tlp"><strong>No Telpon</strong></label>
											<input type="number" name="no_tlp" placeholder="Masukkan no_tlp" autocomplete="off"  class="form-control" required value="<?= $pengguna->no_tlp ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="status"><strong>Status</strong></label>
											<select name="status" id="status" class="form-control" required>
												<option value="">-- Pilih --</option>
												<option value="SPAREPART">SPAREPART</option>
												<option value="KABENG">KABENG</option>
												<option value="OUTLET">OUTLET</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										
										<div class="form-group col-md-6">
											<label for="username"><strong>Username</strong></label>
											<input type="text" name="username" placeholder="Masukkan Username" autocomplete="off"  class="form-control" required value="<?= $pengguna->username ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="password"><strong>Password</strong></label>
											<input type="password" name="password" placeholder="Masukkan Password" autocomplete="off"  class="form-control" required value="<?= $pengguna->password ?>">
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