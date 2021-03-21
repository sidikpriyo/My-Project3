<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title ?></h3>
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td>Kode Transaksi</td>
					<td>Kode Supplier</td>
					<td>Nama Supplier</td>
					<td>Tanggal Terima</td>
					<td>Nama Petugas</td>
					<td>Transaksi</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($transaksi as $penerimaan): ?>
					<tr>
						<td><?= $penerimaan->kode_transaksi_masuk ?></td>
						<td><?= $penerimaan->kode_supplier ?></td>
						<td><?= $penerimaan->nama_supplier ?></td>
						<td><?= $penerimaan->tgl_transaksi_masuk ?></td>
						<td><?= $penerimaan->nama_karyawan ?></td>
						<td><?= 'Rp '. number_format($penerimaan->jumlah) ?></td>
					</tr>
				<?php endforeach ?>

				<?php foreach ($jumlah_tr as $key): ?>
				<tr>
					<td colspan="5">Jumlah</td>
					<td><?= 'Rp '. number_format($key->jumlah)?></td>
					<?php endforeach ?>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>