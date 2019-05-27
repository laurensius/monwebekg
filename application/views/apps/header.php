
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
    <script src="<?php echo base_url('assets/plugins/morrisjs/morris.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/raphael/raphael.js'); ?>"></script>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">EKG System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if($this->uri->segment(2) == null) echo "active"; ?> ">
            <a class="nav-link" href="<?php echo site_url('apps/') ?>">Beranda</span></a>
          </li>
          <li class="nav-item  <?php if($this->uri->segment(2) == 'input_pasien') echo "active"; ?> ">
            <a class="nav-link" href="<?php echo site_url('apps/input_pasien') ?>">Input Pasien</a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(2) == 'monitoring') echo "active"; ?> ">
            <a class="nav-link" href="<?php echo site_url('apps/monitoring') ?>">Monitoring</a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(2) == 'print_result') echo "active"; ?> ">
            <a class="nav-link" href="<?php echo site_url('apps/print_result') ?>">Cetak Data</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>



