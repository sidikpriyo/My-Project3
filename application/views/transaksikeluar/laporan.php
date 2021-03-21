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
				</div>
				<hr>

				<div class="row">
					<div class="col-md-5">
						<div class="card shadow">
							<div class="card-header"><strong>Form Filter By Tanggal</strong></div>
							<div class="card-body">
								<form action="<?= base_url('transaksikeluar/filter') ?>" target='_blank' method="POST">
									<input type="hidden" name="nilaifilter" value="1">
									<div class="form-row">
										<div class="form-group col-6">
											<label>Tanggal Awal</label>
											<input id="datepicker" name="tanggalawal" required="" class="form-control">
										</div>
										<div class="form-group col-6">
											<label>Tanggal Akhir</label>
											<input id="datepicker2" name="tanggalakhir" required="" class="form-control">
										</div>
									<div class="form-row">
										<div class="form-group col-12">
											<input type="submit" value="Cetak" class="btn btn-primary">
										</div>
									</div>
									</div>
								</form>
							</div>				
						</div>
					</div>

					<div class="col-md-7">
						<div class="card shadow">
							<div class="card-header"><strong>Form Filter By Bulan</strong></div>
							<div class="card-body">
								<form action="<?= base_url('transaksikeluar/filter') ?>" target='_blank' method="POST">
									<input type="hidden" name="nilaifilter" value="2">
									<div class="form-row">
										<div class="form-group col-4">
											<label>Pilih Tahun</label>
											<select name="tahun1" required="" class="form-control">
											<?php foreach ($tahun as $row): ?>
											<option value="<?= $row->tahun ?>"><?= $row->tahun ?></option>
											<?php endforeach?>
											</select>
										</div>
										<div class="form-group col-4">
											<label>Bulan Awal</label>
											<select name="bulanawal" required="" class="form-control">
												<option value="1">Januari</option>
												<option value="2">Febuari</option>
												<option value="3">Maret</option>
												<option value="4">April</option>
												<option value="5">Mei</option>
												<option value="6">Juni</option>
												<option value="7">Juli</option>
												<option value="8">Agustus</option>
												<option value="9">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
										<div class="form-group col-4">
											<label>Bulan Akhir</label>
											<select name="bulanakhir" required="" class="form-control">
												<option value="1">Januari</option>
												<option value="2">Febuari</option>
												<option value="3">Maret</option>
												<option value="4">April</option>
												<option value="5">Mei</option>
												<option value="6">Juni</option>
												<option value="7">Juli</option>
												<option value="8">Agustus</option>
												<option value="9">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
										<div class="form-row">
											<div class="form-group col-12">
												<input type="submit" value="Cetak" class="btn btn-primary">
											</div>
										</div>
									</div>
								</form>
							</div>				
						</div>
					</div>

					<div class="col-md-5" style="margin-top: 10px">
						<div class="card shadow">
							<div class="card-header"><strong>Form Filter By Tahun</strong></div>
							<div class="card-body">
								<form action="<?= base_url('transaksikeluar/filter') ?>" target='_blank' method="POST">
									<input type="hidden" name="nilaifilter" value="3">
									<div class="form-row">
										<div class="form-group col-12">
											<label>Pilih Tahun</label>
											<select name="tahun2" required="" class="form-control">
											<?php foreach ($tahun as $row): ?>
											<option value="<?= $row->tahun ?>"><?= $row->tahun ?></option>
											<?php endforeach?>
											</select>
										</div>
										<div class="form-row">
											<div class="form-group col-12">
												<input type="submit" value="Cetak" class="btn btn-primary">
											</div>
										</div>
									</div>
									</div>
								</form>
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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>


	<!-- datepicker -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<script>
        $('#datepicker').datepicker({
        	format: 'yyyy/mm/dd',
            uiLibrary: 'bootstrap4'
        });
         $('#datepicker2').datepicker({
         	format: 'yyyy/mm/dd',
            uiLibrary: 'bootstrap4'
        });
    </script>
</body>
</html>