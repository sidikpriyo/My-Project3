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
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
					</div>
					<hr>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>

					<!-- jumlah -->
					
					<div class="row">
					<div class="col-2">
					<td align="center">
			        <div class="card bg-success text-white" align="center">
			          <div class="card-body" style="font-size: 15px">
			            <h5 class="card-title" style="font-size: 15px">Barang</h5>
			            <?= $jumlah_barang ?>
			          </div>
			        </div>
			      </td>
					</div>

					<div class="col-2">
					<td align="center">
			        <div class="card bg-primary text-white" align="center">
			          <div class="card-body" style="font-size: 15px">
			            <h5 class="card-title" style="font-size: 15px">Pelanggan</h5>
			            <?= $jumlah_customer ?>
			          </div>
			        </div>
			      </td>
					</div>

					<div class="col-2">
					<td align="center">
			        <div class="card bg-secondary text-white" align="center">
			          <div class="card-body" style="font-size: 15px">
			            <h5 class="card-title" style="font-size: 15px">Supplier</h5>
			            <?= $jumlah_supplier ?>
			          </div>
			        </div>
			      </td>
					</div>

					<div class="col-2">
					<td align="center">
			        <div class="card bg-danger text-white" align="center">
			          <div class="card-body" style="font-size: 15px" style="font-size: 15px">
			            <h5 class="card-title" style="font-size: 15px">Petugas</h5>
			            <?= $jumlah_petugas ?>
			          </div>
			        </div>
			      </td>
					</div>

					<div class="col-2">
					<td align="center">
			        <div class="card bg-warning text-white" align="center">
			          <div class="card-body" style="font-size: 15px">
			            <h5 class="card-title" style="font-size: 15px">Transaksi Masuk</h5>
			            <?= $jumlah_penerimaan ?>
			          </div>
			        </div>
			      </td>
					</div>

					<div class="col-2">
					<td align="center">
			        <div class="card bg-success text-white" align="center">
			          <div class="card-body" style="font-size: 15px">
			            <h5 class="card-title" style="font-size: 15px">Transaksi Keluar</h5>
			            <?= $jumlah_pengeluaran ?>
			          </div>
			        </div>
			      </td>
					</div>

					</div>
				</div>

					<!-- slider -->
						<div class="container" style="width: 70%; padding-top: 15px">
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						  <div class="carousel-inner">
						    <div class="carousel-item active">
						      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slide1.jpg?>" alt="First slide">
						    </div>
						    <div class="carousel-item">
						      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slide2.jpg?>" alt="Second slide">
						    </div>
						    <div class="carousel-item">
						      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slide3.jpg?>" alt="Third slide">
						    </div>
						    <div class="carousel-item">
						      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slide4.jpg?>" alt="Third slide">
						    </div>
						    <div class="carousel-item">
						      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slide5.jpg?>" alt="Third slide">
						    </div>
						    <div class="carousel-item">
						      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slide6.jpg?>" alt="Third slide">
						    </div>
						    <!-- <div class="carousel-item">
						      <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slide7.jpg?>" alt="Third slide">
						    </div> -->
						  </div>
						  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
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
</body>
</html>