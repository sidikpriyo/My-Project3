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
					<td><strong>Kode Transaksi Masuk</strong></td>
					<td>:</td>
					<td><?= $penerimaan->kode_transaksi_masuk ?></td>
				</tr>
				<tr>
					<td><strong>Tanggal Transaksi Masuk</strong></td>
					<td>:</td>
					<td><?= $penerimaan->tgl_transaksi_masuk ?></td>
				</tr>
				<tr>
					<td><strong>Kode Supllier</strong></td>
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
						<td><strong>Subtotal</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rincian_transaksi_masuk as $detail): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $detail->kode_part ?></td>
							<td><?= $detail->nama_part ?></td>
							<td><?php echo $detail->qty_masuk?> <?= strtoupper($detail->satuan) ?></td>
						    <td><?php echo 'Rp '. number_format($detail->harga_beli)?></td>
							<td><?php echo 'Rp '. number_format($detail->harga_beli * $detail->qty_masuk)?></td>
							<!-- <?php $total += $detail->harga_beli * $detail->qty_masuk?> -->
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