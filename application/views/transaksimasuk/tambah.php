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
						<a href="<?= base_url('transaksimasuk') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<!-- simpan pada saat transaksi masuk -->
								<form action="<?= base_url('transaksimasuk/proses_tambah') ?>" id="form-tambah" method="POST">
									<h5>Data Petugas</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-3">
											<label>Kode Transaksi Masuk</label>
											<input type="text" name="kode_transaksi_masuk" value="<?= mt_rand(0, 100000) ?>" class="form-control" required>
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
											<label>Tanggal Masuk</label>
											<input type="text" name="tgl_transaksi_masuk" value="<?= date('Y/m/d') ?>" readonly class="form-control">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<h5>Data Supplier</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-10">
													<label for="kode_supplier">Nama Supplier</label>
													<select name="kode_supplier" id="kode_supplier" class="form-control" required>
														<option value="">Pilih Supplier</option>
														<?php foreach ($all_supplier as $supplier): ?>
															<option value="<?= $supplier->kode_supplier ?>"><?= $supplier->nama_supplier ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group col-2">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-danger btn-block" id="reset"><i class="fa fa-times"></i></button>
												</div>
												<input type="hidden" name="kode_supplier" value="">
											</div>
										</div>
										<div class="col-md-8">
											<h5>Data Barang</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-4">
													<label for="kode_part">Nama Part</label>
													<select name="kode_part" id="kode_part" class="form-control" required>
														<option value="">Pilih Part</option>
														<?php foreach ($all_barang as $barang): ?>
															<option value="<?= $barang->kode_part ?>"><?= $barang->kode_part ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div>
													<input type="hidden" name="kode_part" value="" readonly class="form-control">
												</div>
												<div class="form-group col-4">
													<label>Nama Barang</label>
													<input type="text" name="nama_part" value="" readonly class="form-control">
												</div>
												<div class="form-group col-3">
													<label>qty_masuk</label>
													<input type="number" name="qty_masuk" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-1">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
												</div>
												<input type="hidden" name="satuan" value="">
											</div>
										</div>
									</div>
									<div class="keranjang">
										<h5>Detail Penerimaan</h5>
										<hr>
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
													<!-- <td width="15%">Kode Rincian Masuk</td>
													<td width="15%">Kode Transaksi</td> -->
													<td width="15%">Kode Barang</td>
													<td width="15%">Nama Barang</td>
													<td width="15%">Jumlah Masuk</td>
													<td width="15%">Aksi</td>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
											<tfoot>
												<tr>
													<td colspan="5" align="center">
														<input type="hidden" name="max_hidden" value="">
														<button type="submit" class="btn btn-primary"><i class="fa fa-save">
															<!-- menyimpan transaksi masuk -->
														</i>&nbsp;&nbsp;Simpan</button>
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

			$('#kode_supplier').on('change', function(){
				$(this).prop('disabled', true)
				$('#reset').prop('disabled', false)
				$('input[name="kode_supplier"]').val($(this).val())
			})

			$(document).on('click', '#reset', function(){
				$('#kode_supplier').val('')
				$('#kode_supplier').prop('disabled', false)
				$(this).prop('disabled', true)
				$('input[name="kode_supplier"]').val('')
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
							$('input[name="harga_beli"]').val(data.harga_jual)
							$('input[name="qty_masuk"]').val(1)
							$('input[name="satuan"]').val(data.satuan)
							$('input[name="max_hidden"]').val(data.qty)
							$('input[name="qty_masuk"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="qty_masuk"]').val() * $('input[name="harga_beli"]').val())
							
							$('input[name="qty_masuk"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="qty_masuk"]').val() * $('input[name="harga_beli"]').val())
							})
						}
					})
				}
			})

			$(document).on('click', '#tambah', function(e){
				const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
				const data_keranjang = {
					// kode_part: $('select[name="kode_part"]').val()
					kode_part: $('input[name="kode_part"]').val(),
					nama_part: $('input[name="nama_part"]').val(),
					qty_masuk: $('input[name="qty_masuk"]').val(),
					// satuan: $('input[name="satuan"]').val(),
				}

				$.ajax({
					url: url_keranjang_barang,
					type: 'POST',
					data: data_keranjang,
					success: function(data){
						if($('select[kode_part="kode_part"]').val() == data_keranjang.kode_part) $('option[value="' + data_keranjang.kode_part + '"]').hide()
						reset()

						$('table#keranjang tbody').append(data)
						$('tfoot').show()

						$('#total').html('<strong>' + hitung_total() + '</strong>')
						$('input[name="total_hidden"]').val(hitung_total())
					}
				})
			})


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('nama-barang') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="kode_part"]').prop('disabled', true)
				$('select[name="kode_part"]').prop('disabled', true)
				$('input[name="satuan"]').prop('disabled', true)
				$('input[name="qty_masuk"]').prop('disabled', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#kode_part').val('')
				$('input[name="kode_part"]').val('')
				$('input[name="qty_masuk"]').val('')
				$('input[name="qty_masuk"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
</body>
</html>