<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
</head>
<body onload="window.print()">

	<h1><?= $title ?></h1>
	<h2><?= $subtitle ?></h2>

	<br>
	<br>

	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>kode Transaksi Keluar</th>
				<th>Tanggal Transaksi Keluar</th>
				<th>Nama Pelanggan</th>
				<th>Nama Petugas</th>
				<th>Jumlah Transaksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach ($datafilter as $r): ?>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $r->kode_transaksi_keluar; ?></td>
				<td><?= $r->tgl_transaksi_keluar; ?></td>
				<td><?=	$r->nama_pelanggan;  ?></td>
				<td><?= $r->nama_karyawan ?></td>
				<td><?= 'Rp '. number_format($r->jumlah) ?></td>
			</tr>
			<?php endforeach; ?>
			<?php foreach ($jumlah_tr as $key): ?>
			<tr>
				<td colspan="5">Jumlah</td>
				<td><?='Rp '.number_format($key->jumlah)?></td>
				<?php endforeach ?>
			</tr>
		</tbody>
	</table>


</body>
</html>