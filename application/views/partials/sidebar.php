<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard')?>">
				<div class="sidebar-brand-icon">
					<i class="fa fa-user-cog"></i>
				</div>
				<div class="sidebar-brand-text mx-3"><?= $this->session->userdata('status'); ?></div>
			</a>
			<hr class="sidebar-divider my-0">
			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>
			<hr class="sidebar-divider">

			<div class="sidebar-heading">
				Master
			</div>

			<!-- menu outlet -->
			<?php if($this->session->userdata['status']=='OUTLET'):  ?>
			<li class="nav-item <?= $aktif == 'part' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('part') ?>">
					<i class="fas fa-fw fa-box"></i>
					<span>Master part</span></a>
			</li>
			<li class="nav-item <?= $aktif == 'pelanggan' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('pelanggan') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Pelanggan</span></a>
			</li>

			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
				Transaksi
			</div>

			<li class="nav-item <?= $aktif == 'transaksikeluar' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('transaksikeluar') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Transaksi Keluar</span></a>
			</li>
		<?php  endif;?>

		<!-- menu Kabeng -->
		<?php if($this->session->userdata['status']=='KABENG'):  ?>
			<li class="nav-item <?= $aktif == 'part' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('part') ?>">
					<i class="fas fa-fw fa-box"></i>
					<span>Master part</span></a>
			</li>
			<li class="nav-item <?= $aktif == 'pelanggan' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('pelanggan') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Pelanggan</span></a>
			</li>
			<li class="nav-item <?= $aktif == 'supplier' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('supplier') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Supplier</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'pengguna' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('pengguna') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Karyawan</span></a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
				Transaksi
			</div>

			<li class="nav-item <?= $aktif == 'transaksimasuk' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('transaksimasuk') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Transaksi Masuk</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'transaksikeluar' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('transaksikeluar') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Transaksi Keluar</span></a>
			</li>
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
				Forcasting
			</div>

			<li class="nav-item <?= $aktif == 'forcesting' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('forcesting') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Forcesting</span></a>
			</li>
		<?php  endif;?>
			
			<!-- menu Sparepart -->
			<?php if($this->session->userdata['status']=='SPAREPART'):  ?>
			<li class="nav-item <?= $aktif == 'part' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('part') ?>">
					<i class="fas fa-fw fa-box"></i>
					<span>Master part</span></a>
			</li>
			<li class="nav-item <?= $aktif == 'pelanggan' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('pelanggan') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Pelanggan</span></a>
			</li>
			<li class="nav-item <?= $aktif == 'supplier' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('supplier') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Supplier</span></a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
				Transaksi
			</div>

			<li class="nav-item <?= $aktif == 'transaksimasuk' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('transaksimasuk') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Transaksi Masuk</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'transaksikeluar' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('transaksikeluar') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Transaksi Keluar</span></a>
			</li>
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
				Forcasting
			</div>
			<li class="nav-item <?= $aktif == 'forcesting' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('forcesting') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Forecasting</span></a>
			</li>
		<?php  endif;?>

			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>