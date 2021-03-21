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
						<a href="<?= base_url('pelanggan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
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
					<div class="card-header"><strong><?= $title ?> - <?= $pelanggan->kode_pelanggan ?></strong></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<table class="table table-borderless">
									<tr>
										<td><strong>Kode Pelanggan</strong></td>
										<td>:</td>
										<td><?= $pelanggan->kode_pelanggan ?></td>
									</tr>
									<tr>
										<td><strong>Nomor KTP</strong></td>
										<td>:</td>
										<td><?= $pelanggan->no_ktp ?></td>
									</tr>
									<tr>
										<td><strong>Nama Pelanggan</strong></td>
										<td>:</td>
											<td><?= $pelanggan->nama_pelanggan ?></td>
									</tr>
									<tr>
										<td><strong>Alamat</strong></td>
										<td>:</td>
										<td><?= $pelanggan->alamat_pelanggan ?></td>
									</tr>
									<tr>
										<td><strong>Telpon/HP</strong></td>
										<td>:</td>
										<td><?= $pelanggan->no_tlp ?></td>
									</tr>
									<tr>
										<td><strong>Nomor Polisi Kendaraan</strong></td>
										<td>:</td>
										<td><?= $pelanggan->no_polisi ?></td>
									</tr>
									<tr>
										<td><strong>Nomor Rangka Kendaraan</strong></td>
										<td>:</td>
										<td><?= $pelanggan->no_rangka ?></td>
									</tr>
									<tr>
										<td><strong>Kode Model Kendaraan</strong></td>
										<td>:</td>
										<td><?= $pelanggan->kode_model ?></td>
									</tr>
									<tr>
										<td><strong>Model Kendaraan</strong></td>
										<td>:</td>
										<td><?= $pelanggan->model ?></td>
									</tr>
									<tr>
										<td><strong>Tahun Perakitan</strong></td>
										<td>:</td>
										<td><?= $pelanggan->tahun ?></td>
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