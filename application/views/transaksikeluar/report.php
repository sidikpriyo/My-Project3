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
					<td>Tanggal Keluar</td>
					<td>Nama Pelanggan</td>
					<td>Nama Petugas</td>
					<td>Jumlah Transaksi</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($transaksi as $keluar): ?>
					<tr>
						<td><?= $keluar->kode_transaksi_keluar ?></td>
						<td><?= $keluar->tgl_transaksi_keluar ?></td>
						<td><?= $keluar->nama_pelanggan ?></td>
						<td><?= $keluar->nama_karyawan ?></td>
						<td><?= 'Rp '. number_format($keluar->jumlah) ?></td>
					</tr>
				<?php endforeach ?>

				<?php foreach ($jumlah_tr as $key): ?>
				<tr>
					<td colspan="4">Jumlah</td>
					<td><?= 'Rp '. number_format($key->jumlah)?></td>
					<?php endforeach ?>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>