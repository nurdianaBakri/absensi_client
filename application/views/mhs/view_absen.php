<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SI Absensi Dosen PSTI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/skins/_all-skins.min.css">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
<script src="<?php echo base_url()."assets"; ?>/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- DataTables -->
<!-- <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
<!-- DataTables -->
<!-- <script src="<?php echo base_url()."assets"; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."assets"; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url()."assets"; ?>/index2.html" class="navbar-brand"><b>SI-Absensi</b>PSTI</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse"> 
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
              
            <!-- User Account Menu -->
            <li class="user user-menu">
              <!-- Menu Toggle Button -->
              <a href="<?= base_url('Login/login') ?>" >
                Login 
              </a> 
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Daftar Absensi Pegawai Program Studi Teknik Informatika UNRAM
          <small><?= date('d, M Y') ?></small>
        </h1> 
      </section>

      <!-- Main content -->
      <section class="content"> 
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><?= date('D  d, M Y') ?></h3>
          </div>
          <div class="box-body">

            <div class="result"></div>


             <script>

              (function worker() {
                $.ajax({
                  url: "<?= base_url()."Login/getAbsensi" ?>", 
                  success: function(data) {
                    // console.log(data);
                    $('.result').html(data);
                  },
                  complete: function() {
                    // Schedule the next request when the current one's complete
                    setTimeout(worker, 5000);
                  }
                });
              })();
                 
              </script> 
          </div> 
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper --> 

<!-- jQuery 3 -->
<script src="<?php echo base_url()."assets"; ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()."assets"; ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()."assets"; ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()."assets"; ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()."assets"; ?>/dist/js/demo.js"></script>
</body>
</html>
