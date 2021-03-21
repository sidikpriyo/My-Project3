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
					<td>No</td>
					<td>Kode Supplier</td>
					<td>Nama Supplier</td>
					<td>Telepon</td>
					<td>Email</td>
					<td>Alamat Supplier</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($all_supplier as $supplier): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $supplier->kode_supplier ?></td>
					<td><?= $supplier->nama_supplier ?></td>
					<td><?= $supplier->no_tlp ?></td>
					<td><?= $supplier->email ?></td>
					<td><?= $supplier->alamat_supplier ?></td>
				</tr>	
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>