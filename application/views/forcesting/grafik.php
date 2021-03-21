<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css">

    <title>Grafik</title>
  </head>
  <body>
  <script src="<?php echo base_url() ?>js/chart.js@2.8.0"></script>

  <div class="container-fluid" style="margin-top: 10px;padding-left: 10%;padding-right: 10%;">
    <!-- Judul -->
      <div class="clearfix">
            <div class="float-left">
              <h1 class="h3 m-0 text-gray-800">FORECASTING : <?= $pt->nama_part ?> (<?= $pt->kode_part ?>)</h1>
            </div>
          </div>
          <hr>
    <!-- end of judul  -->
    
    <!-- pencarian -->
    <div class="container" align="center">
    <div class="row" style="width:50%">
        <div class="col 4" align="center">
          <?php foreach ($forcasting as $f): ?>
          <form action="<?=base_url('forcesting/grafik/' . $f->kode_part)?>" method="POST">
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
  <div class="col-sm-4" style="margin-left: 40px">
  <h5 class="text-center">Detail</h5><p></p>
    <table class="table table-bordered">
      <tr class="text-center">
        <th>Periode</th>
        <th>Actual</th>
        <th>Forcasting</th>
        <th>Absolut</th>
      </tr>
      <?php foreach ($detail as $data) {?>
      <tr>
        <td class="text-center"><?php echo $data->datex; ?></td>
        <td class="text-right"><?php echo $data->qty; ?></td>
        <td class="text-right"><?php echo $data->forcasting; ?></td>
        <td class="text-right"><?php echo $data->atfc; ?></td>
      </tr>
    <?php }?>
    <tr>
      <td colspan="3"><b>MAD</b></td>
      <td class="text-right"><?php foreach ($mad_mape as $data) {echo $data->mad;}?></td>
    </tr>
    <tr>
      <td colspan="3"><b>MAPE</b></td>
      <td class="text-right"><?php foreach ($mad_mape as $data) {echo $data->mape;}?> %</td>
    </tr>
    </table>
  </div>

  <div class="col-sm-7">
  <canvas id="myChart" width="100%"></canvas>
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

<!-- safety, mad, map -->
<div class="container-fluid" style="width: 50%">
<div class="row">
          <div class="col-4">
          <td align="center">
              <div class="card bg-success text-white" align="center">
                <div class="card-body">
                  <h5 class="card-title">Safety Stok</h5>
                  <?=$safety;?>
                </div>
              </div>
            </td>
          </div>

          <div class="col-4">
          <td align="center">
              <div class="card bg-primary text-white" align="center">
                <div class="card-body">
                  <h5 class="card-title">MAD</h5>
                  <?php foreach ($mad_mape as $data) {
                  $mad = $data->mad;
                  echo "$mad";
                }?>
                </div>
              </div>
            </td>
          </div>

          <div class="col-4">
          <td align="center">
              <div class="card bg-danger text-white" align="center">
                <div class="card-body">
                  <h5 class="card-title">MAPE</h5>
                  <?php foreach ($mad_mape as $data) {
                  $mape = $data->mape;
                  echo "$mape %";
                }?>
                </div>
              </div>
            </td>
          </div>
        </div>
</div>
<!-- end of safety,mad,mape -->
</body>
</html>