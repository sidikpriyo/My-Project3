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
			<div id="content" data-url="<?= base_url('transaksikeluar') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('transaksikeluar') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<!-- memproses data saat input -->
								<form action="<?= base_url('transaksikeluar/proses_tambah') ?>" id="form-tambah" method="POST">
									<h5 style="font-weight: bold;color: blue">Data Petugas</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-3">
											<label>Kode Transaksi Keluar</label>
											<input type="text" name="kode_transaksi_keluar" value="<?= mt_rand(0, 100000) ?>" class="form-control" required>
										</div>
										<div class="form-group col-3">
											<label>Kode Karyawan</label>
											<input type="text" name="kode_karyawan" value="<?= $this->session->userdata['kode_karyawan'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-3">
											<label>Nama Karyawan</label>
											<input type="text" name="nama_karyawan" value="<?= $this->session->userdata['nama_karyawan'] ?>" class="form-control" readonly>
										</div>
										<div class="form-group col-3">
											<label>Tanggal Transaksi Keluar</label>
											<input type="text" name="tgl_transaksi_keluar" value="<?= date('d/m/Y') ?>" class="form-control" readonly>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h5 style="font-weight: bold;color: blue">Data Pelanggan</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-3">
													<label for="kode_pelanggan">Nomor Kendaraan</label>
												<select class="custom-select" name="kode_pelanggan" id="kode_pelanggan" required>
												    <option value="">Pilih Nopol Kendaraan</option>
														<?php foreach ($all_customer as $pelanggan): ?>
															<option value="<?= $pelanggan->kode_pelanggan ?>"><?= $pelanggan->no_polisi ?></option>
														<?php endforeach ?>
												</select>
												</div>
												<div class="form-group col-3">
													<label>Nama Pelanggan</label>
													<input type="text" name="nama_pelanggan" value="" readonly class="form-control">
												</div>
												<div class="form-group col-1">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-danger btn-block" id="reset"><i class="fa fa-times"></i></button>
												</div>
												<input type="hidden" name="kode_pelanggan" value="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h5 style="font-weight: bold;color: blue">Data Barang</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-3">
													<label for="kode_part">Nama Part</label>
													<select class="custom-select" name="kode_part" id="kode_part" required>
														<option value="">Pilih Part</option>
														<?php foreach ($all_barang as $barang): ?>
															<option value="<?= $barang->kode_part ?>"><?= $barang->kode_part ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group col-1">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
												</div>
												<div>
													<input type="hidden" name="kode_part" value="" readonly class="form-control">
												</div>
												<div class="form-group col-1">
													<label>Jumlah</label>
													<input type="number" name="qty_keluar" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-4">
													<label>Nama Barang</label>
													<input type="text" name="nama_part" value="" readonly class="form-control">
												</div>
												<input type="hidden" name="satuan" value="">
											</div>
										</div>
									</div>
									<div class="keranjang">
										<h5 style="font-weight: bold;color: blue">Detail Penerimaan</h5>
										<hr>
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
													<td width="15%">Kode Barang</td>
													<td width="15%">Nama Barang</td>
													<td width="15%">Jumlah keluar</td>
													<td width="15%">Aksi</td>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
											<tfoot>
												<tr>
													<td colspan="5" align="center">
														<input type="hidden" name="max_hidden" value="">
														<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</form>
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
	<script>
		$(document).ready(function(){
			$('tfoot').hide()

			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})

			// select
			$(document).ready(function() {
			    $('.custom-select').select2();
			});

			// $('#kode_pelanggan').on('change', function(){
			// 	$(this).prop('disabled', true)
			// 	$('#reset').prop('disabled', false)
			// 	$('input[name="kode_pelanggan"]').val($(this).val())
			// 	$('input[name="nama_pelanggan"]').val($(this).val())
			// })

			$('#kode_pelanggan').on('change', function(){

				if($(this).val() == '') reset()
				else {
					const url_get_all_pelanggan = $('#content').data('url') + '/get_all_pelanggan'
					$.ajax({
						url: url_get_all_pelanggan,
						type: 'POST',
						dataType: 'json',
						data: {kode_pelanggan: $(this).val()},
						success: function(data){
							$('input[name="kode_pelanggan"]').val(data.kode_pelanggan)
							$('input[name="nama_pelanggan"]').val(data.nama_pelanggan)
							$(this).prop('disabled', true)
							$('#reset').prop('disabled', false)
						}
					})
				}
			})
			

			$(document).on('click', '#reset', function(){
				$('#kode_pelanggan').val('')
				$('#kode_pelanggan').prop('disabled', false)
				$('#nama_pelanggan').val('')
				$('#nama_pelanggan').prop('disabled', false)
				$(this).prop('disabled', true)
				$('input[name="no_polisi"]').val('')
				$(this).prop('disabled', true)
				$('input[name="nama_pelanggan"]').val('')
			})

			$('#kode_part').on('change', function(){

				if($(this).val() == '') reset()
				else {
					const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					$.ajax({
						url: url_get_all_barang,
						type: 'POST',
						dataType: 'json',
						data: {kode_part: $(this).val()},
						success: function(data){
							$('input[name="kode_part"]').val(data.kode_part)
							$('input[name="nama_part"]').val(data.nama_part)
							$('input[name="harga"]').val(data.harga_jual)
							$('input[name="qty_keluar"]').val(1)
							$('input[name="satuan"]').val(data.satuan)
							$('input[name="max_hidden"]').val(data.qty)
							$('input[name="qty_keluar"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="qty_keluar"]').val() * $('input[name="harga"]').val())
							
							$('input[name="qty_keluar"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="qty_keluar"]').val() * $('input[name="harga"]').val())
							})
						}
					})
				}
			})

			$(document).on('click', '#tambah', function(e){
				const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
				const data_keranjang = {
					// nama_part: $('select[name="nama_part"]').val(),
					kode_part: $('input[name="kode_part"]').val(),
					nama_part: $('input[name="nama_part"]').val(),
					qty_keluar: $('input[name="qty_keluar"]').val(),
					// satuan: $('input[name="satuan"]').val(),
				}

				if(parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_keranjang.qty_keluar)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				} else {
					$.ajax({
					url: url_keranjang_barang,
					type: 'POST',
					data: data_keranjang,
					success: function(data){
						if($('select[nama_part="kode_part"]').val() == data_keranjang.kode_part) $('option[value="' + data_keranjang.kode_part + '"]').hide()
						reset()

						$('table#keranjang tbody').append(data)
						$('tfoot').show()

						$('#total').html('<strong>' + hitung_total() + '</strong>')
						$('input[name="total_hidden"]').val(hitung_total())
					}
					})
				}
			})


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('nama-barang') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="kode_part"]').prop('disabled', true)
				$('select[name="nama_part"]').prop('disabled', true)
				$('input[name="satuan"]').prop('disabled', true)
				$('input[name="qty_keluar"]').prop('disabled', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#nama_part').val('')
				$('input[name="kode_part"]').val('')
				$('input[name="qty_keluar"]').val('')
				$('input[name="qty_keluar"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
</body>
</html>