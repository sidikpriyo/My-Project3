<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
  <script src="<?php echo base_url() ?>js/chart.js@2.8.0"></script>
  <div id="wrapper">
    <!-- load sidebar -->
    <?php $this->load->view('partials/sidebar.php') ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content" data-url="<?= base_url('part') ?>">
        <!-- load Topbar -->
        <?php $this->load->view('partials/topbar.php') ?>

        <div class="container-fluid">
        <div class="clearfix">
          <div class="float-left">
             <h1 class="h3 m-0 text-gray-800">FORECASTING : <?= $pt->nama_part ?> (<?= $pt->kode_part ?>)</h1>
          </div>
        </div>
        <hr>

         <script src="<?php echo base_url() ?>js/chart.js@2.8.0"></script>

  <div class="container-fluid" style="margin-top: 10px;padding-left: 10%;padding-right: 10%;">
    <!-- pencarian -->
    <div class="container" align="center">
    <div class="row" style="width:50%">
        <div class="col 4" align="center">
          <?php foreach ($forcasting as $f): ?>
          <form action="<?=base_url('forcesting/chart/' . $f->kode_part)?>" method="POST">
          <?php endforeach?>
          <select name="tahun_cari" class="form-control">
        <?php
        foreach ($tahun as $data) {
          $tahun_cari = $data->th;
          echo "<option value='" . $tahun_cari . "'>$tahun_cari</option>";
        }?>
      </select>
        </div>
        <div class="col 4" align="center">
          <button type="submit" class="btn btn-success form-control">Cari</button>
        </div>
        <div class="col 4" align="center">
          <a class="btn btn-primary form-control" href="<?=base_url('forcesting')?>">Kembali</a>
        </div>
      </form>
      </div>     
   </div>
    <!-- end of pencarian -->
      </div>
<!-- tabel dan grafik -->
<div class="row" style="margin-top: 30px;padding-left: 4%;padding-right: 4%">

  <div class="col-sm-9">
  <canvas id="myChart" width="100%"></canvas>
  </div>
   <div class="col-sm-3" style="margin-top: 30px">
            <div class="col-10" style="padding-bottom: 15px">
                  <div class="card bg-success text-white" align="center">
                    <div class="card-body" style="font-size: 14px">
                      <h5 class="card-title" style="font-size: 15px">Safety Stok</h5>
                      <?=$safety;?>
                    </div>
                  </div>
            </div>

            <div class="col-10" style="padding-bottom: 15px">
                  <div class="card bg-primary text-white" align="center">
                    <div class="card-body" style="font-size: 14px">
                     <h5 class="card-title" style="font-size: 15px">MAD</h5>
                          <?php foreach ($mad_mape as $data) {
                          $mad = $data->mad;
                          echo "$mad";
                        }?>
                    </div>
                  </div>
            </div>

            <div class="col-10">
                  <div class="card bg-danger text-white" align="center">
                    <div class="card-body" style="font-size: 14px">
                      <h5 class="card-title" style="font-size: 15px">MAPE</h5>
                          <?php foreach ($mad_mape as $data) {
                          $mape = $data->mape;
                          echo "$mape %";
                        }?>
                    </div>
                  </div>
            </div>
         </div>
  
</div>


<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php
foreach ($tmonth as $data) {
  echo "'" . date('M Y', strtotime($data)) . "',";
}
?>],
        datasets: [{
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            fill:false,
            label: 'Penjualan',
            data: [<?php
foreach ($grap as $data) {
  echo $data['qty'] == null || $data['qty'] == 0 ? null . "," : "'" . @$data['qty'] . "',";
}
?>]},
        {
            backgroundColor: 'rgba(100, 99, 132, 0.2)',
            borderColor: 'rgba(100, 99, 132, 1)',
            borderWidth: 1,
            fill:false,
            label: 'Forcasting',
            data: [<?php
foreach ($grap as $data) {
  echo $data['forcasting'] == 0 ? null . "," : "'" . @$data['forcasting'] . "',";
}
?>],
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 0,
                }
            }]
        }
    }
});
</script>
<!-- end of tabel grafik -->



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