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
			<div id="content" data-url="<?= base_url('pelanggan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						
							<a href="<?= base_url('pelanggan/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
							<a href="<?= base_url('pelanggan/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						
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
				<div class="card shadow">
					<div class="card-header"><strong>Daftar Pelanggan</strong></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr align="center">
										<td>No</td>
										<td>NO POLISI</td>
										<td>Kode Pelanggan</td>
										<td>Nama</td>
										<td>Kode Model</td>
										<td>Model</td>
										<td>Alamat</td>
										<td>Aksi</td>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($all_customer as $customer): ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $customer->no_polisi ?></td>
									    <td><?= $customer->kode_pelanggan ?></td>
										<td><?= $customer->nama_pelanggan ?></td>
										<td><?= $customer->kode_model ?></td>
										<td><?= $customer->model?></td>
										<td><?= $customer->alamat_pelanggan ?></td>
										<td align="center">
											<a href="<?= base_url('pelanggan/detail/' . $customer->kode_pelanggan) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
											<a href="<?= base_url('pelanggan/ubah/' . $customer->kode_pelanggan) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
											<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('pelanggan/hapus/' . $customer->kode_pelanggan) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
										</td>
									</tr>	
								<?php endforeach ?>
								</tbody>
							</table>
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
</body>
</html>