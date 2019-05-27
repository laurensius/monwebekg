<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>EKG System</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/starter-template.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
  </head>
  <body>
    <main role="main" class="container">
      <div class="row">
        <table class="table">
          <thead>
            <tr>
              <td colspan="3"><h3>Data Pasien</h3></td>
            </tr>
            <?php
            foreach($patient as $p){
            ?>
            <tr>
              <td> Nama Pasien </td>
              <td colspan="2"> : <?php echo $p->name; ?></td>
            </tr>
            <tr>
              <td> Umur </td>
              <td colspan="2"> :<?php echo $p->age; ?></td>
            </tr>
            <tr>
              <td> JK </td>
              <td colspan="2"> : <?php echo $p->gender; ?></td>
            </tr>
            <tr>
              <td> Alamat </td>
              <td colspan="2"> : <?php echo $p->address; ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
              <td colspan="3"><br><br><br><br></td>
            </tr>
            <tr>
              <td colspan="3"><h3>Log BPM</h3></td>
            </tr>
          </thead>
          <tbody id="tabel_data">
            <tr>
              <td><b>No</b></td>
              <td><b>BPM</b></td>
              <td><b>Tanggal (Waktu Pengukuran) </b></td>
            </tr>
            <?php
              $ctr = 1;
              foreach($bpm as $item){
                echo "<tr>";
                echo "<td>" . $ctr . "</td>";
                echo "<td>" . $item->bpm . "</td>";
                echo "<td>" . $item->datetime . "</td>";
                echo "</tr>";
                $ctr++;
              }
            ?>
          </tbody>
        </table>
      </div>
    </main>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  </body>
</html>
<?php

$file="Report.xls";
header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=$file");
?>