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
		<div class="col-md-4">
			<table class="table table-borderless">
				<tr>
					<td><strong>Kode Transaksi Keluar</strong></td>
					<td>:</td>
					<td><?= $data_transaksi_keluar->kode_transaksi_keluar ?></td>
				</tr>
				<tr>
					<td><strong>Nama Karyawan</strong></td>
					<td>:</td>
					<td><?= $data_transaksi_keluar->nama_karyawan ?></td>
				</tr>
				<tr>
					<td><strong>Nama Pelanggan</strong></td>
					<td>:</td>
					<td><?= $data_transaksi_keluar->nama_pelanggan ?></td>
				</tr>
				<tr>
					<td><strong>No Polisi</strong></td>
					<td>:</td>
					<td><?= $data_transaksi_keluar->no_polisi ?></td>
				</tr>
				<tr>
					<td><strong>Tanggal Transaksi Keluar</strong></td>
					<td>:</td>
					<td><?= $data_transaksi_keluar->tgl_transaksi_keluar ?></td>
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
						<td><strong>Kode Part</strong></td>
						<td><strong>Nama Part</strong></td>
						<td><strong>Jumlah</strong></td>
						<td><strong>Harga</strong></td>
						<td><strong>Subtotal</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rincian_transaksi_keluar as $detail_keluar): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $detail_keluar->kode_part ?></td>
							<td><?= $detail_keluar->nama_part ?></td>
							<td><?= $detail_keluar->qty_keluar ?> </td>
							<td><?php echo 'Rp '. number_format($detail_keluar->harga)?></td>
							<td><?php echo 'Rp '. number_format($detail_keluar->harga * $detail_keluar->qty_keluar)?></td>
							<!-- <?php $total += $detail_keluar->harga * $detail_keluar->qty_keluar?> -->
						</tr>
					<?php endforeach ?>
					<tr>
					  <td colspan="5" style=""><b>Total</b></td>
					  <td style=""><?php echo 'Rp ' . number_format($total); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>