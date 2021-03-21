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
			<div id="content" data-url="<?= base_url('transaksimasuk') ?>">
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
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php elseif($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<div class="card shadow">
					<div class="card-header"><strong><?= $title ?> - <?= $karyawan->kode_karyawan ?></strong></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<table class="table table-borderless">
									<tr>
										<td><strong>Kode karyawan</strong></td>
										<td>:</td>
										<td><?= $karyawan->kode_karyawan ?></td>
									</tr>
									<tr>
										<td><strong>Nama Karyawan</strong></td>
										<td>:</td>
										<td><?= $karyawan->nama_karyawan ?></td>
									</tr>
									<tr>
										<td><strong>Email</strong></td>
										<td>:</td>
											<td><?= $karyawan->email ?></td>
									</tr>
									<tr>
										<td><strong>Alamat</strong></td>
										<td>:</td>
										<td><?= $karyawan->alamat ?></td>
									</tr>
									<tr>
										<td><strong>Telpon/HP</strong></td>
										<td>:</td>
										<td><?= $karyawan->no_tlp ?></td>
									</tr>
									<tr>
										<td><strong>Status</strong></td>
										<td>:</td>
										<td><?= $karyawan->status ?></td>
									</tr>
									<tr>
										<td><strong>Username</strong></td>
										<td>:</td>
										<td><?= $karyawan->username ?></td>
									</tr>
									<tr>
										<td><strong>Password</strong></td>
										<td>:</td>
										<td><?= $karyawan->password ?></td>
									</tr>
									
								</table>
							</div>
						</div>
						<hr>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>