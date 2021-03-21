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
						<a href="<?= base_url('transaksimasuk/laporan') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Cetak Laporan</a>
						<a href="<?= base_url('transaksimasuk/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
						<a href="<?= base_url('transaksimasuk/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><strong>Data Transaksi Masuk</strong></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead style="text-align: center;">
									<tr>
										<td>No</td>
										<td>Kd Transaksi</td>
										<td>Kd Supplier</td>
										<td>Nama Supplier</td>
										<td>Tanggal Transaksi</td>
										<td>Petugas</td>
										<td>Jumlah transaksi</td>
										<td>Rincian</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_penerimaan as $penerimaan): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $penerimaan->kode_transaksi_masuk ?></td>
											<td><?= $penerimaan->kode_supplier ?></td>
											<td><?= $penerimaan->nama_supplier ?></td>
											<td><?= $penerimaan->tgl_transaksi_masuk ?></td>
											<td><?= $penerimaan->nama_karyawan ?></td>
											<td><?= 'Rp '. number_format($penerimaan->jumlah)?></td>
											<!-- <td><?= 'Rp '. number_format($penerimaan->harga_beli * $penerimaan->qty_masuk)?></td> -->
											<td style="text-align: center;">
												<a href="<?= base_url('transaksimasuk/detail/' . $penerimaan->kode_transaksi_masuk) ?>">Lihat</a>
												<!-- <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('transaksimasuk/hapus/' . $penerimaan->kode_transaksi_masuk) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
											</td>
										</tr>
									<?php endforeach ?>
									
								</tbody>
								<?php foreach ($jumlah_tr as $key): ?>
									<tr>
										<td colspan="6">Jumlah Transaksi Masuk</td>
										<td><?= 'Rp '. number_format($key->jumlah)?></td>
										<td></td>
										<?php endforeach ?>
									</tr>
							</table>
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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>