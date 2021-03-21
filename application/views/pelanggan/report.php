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
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td width="20px">No</td>
					<td>Kode Pelanggan</td>
					<td>Nomor KTP</td>
					<td>Nama Pelanggan</td>
					<td>Alamat</td>
					<td>Telepon</td>
					<td>Nopol Kendaraan</td>
					<td>Noka Kendaraan</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($all_customer as $customer): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $customer->kode_pelanggan ?></td>
					<td><?= $customer->no_ktp ?></td>
					<td><?= $customer->nama_pelanggan ?></td>
					<td><?= $customer->alamat_pelanggan ?></td>
					<td><?= $customer->no_tlp ?></td>
					<td><?= $customer->no_polisi ?></td>
					<td><?= $customer->no_rangka ?></td>
				</tr>	
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>