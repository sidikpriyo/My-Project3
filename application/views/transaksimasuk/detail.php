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
						<a href="<?= base_url('transaksimasuk/export_detail/' . $penerimaan->kode_transaksi_masuk) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
						<a href="<?= base_url('transaksimasuk') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
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
					<div class="card-header"><strong><?= $title ?> - <?= $penerimaan->kode_transaksi_masuk ?></strong></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<table class="table table-borderless">
									<tr>
										<td><strong>No Transaksi</strong></td>
										<td>:</td>
										<td><?= $penerimaan->kode_transaksi_masuk ?></td>
									</tr>
									<tr>
										<td><strong>Waktu Transaksi</strong></td>
										<td>:</td>
										<td><?= $penerimaan->tgl_transaksi_masuk ?></td>
									</tr>
									<tr>
										<td><strong>kode Supplier</strong></td>
										<td>:</td>
											<td><?= $penerimaan->kode_supplier ?></td>
									</tr>
									<tr>
										<td><strong>Nama Supplier</strong></td>
										<td>:</td>
										<td><?= $penerimaan->nama_supplier ?></td>
									</tr>
									<tr>
										<td><strong>Nama Petugas</strong></td>
										<td>:</td>
										<td><?= $penerimaan->nama_karyawan ?></td>
									</tr>
									
								</table>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<td><strong>No</strong></td>
											<td><strong>Kode Barang</strong></td>
											<td><strong>Nama Barang</strong></td>
											<td><strong>Jumlah</strong></td>
											<td><strong>Harga Beli</strong></td>
											<td><strong>Sub Total</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($rincian_transaksi_masuk as $b): ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?php echo $b->kode_part?></td>
											    <td><?php echo $b->nama_part?></td>
											    <td><?php echo $b->qty_masuk?> <?= strtoupper($b->satuan) ?></td>
											    <td><?php echo 'Rp '. number_format($b->harga_beli)?></td>
     											<td><?php echo 'Rp '. number_format($b->harga_beli * $b->qty_masuk)?></td>
											</tr>
											<!-- <?php $total += $b->harga_beli * $b->qty_masuk?> -->
										<?php endforeach ?>
										<tr>
										  <td colspan="5" style=""><b>Total</b></td>
										  <td style=""><?php echo 'Rp ' . number_format($total); ?></td>
										</tr>
									</tbody>
								</table>
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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>