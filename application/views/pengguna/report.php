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
					<td>Kode Karyawan</td>
					<td>Nama Karyawan</td>
					<td>Email</td>
					<td>Alamat</td>
					<td>No Telpon</td>
					<td>Status</td>
					<td>Username</td>
					<td>Password</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_pengguna as $pengguna): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $pengguna->kode_karyawan ?></td>
						<td><?= $pengguna->nama_karyawan ?></td>
						<td><?= $pengguna->email ?></td>
						<td><?= $pengguna->alamat ?></td>
						<td><?= $pengguna->no_tlp ?></td>
						<td><?= $pengguna->status ?></td>
						<td><?= $pengguna->username ?></td>
						<td><?= $pengguna->password ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>