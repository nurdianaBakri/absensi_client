<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Kehadiran Dosen Di Program Studi Teknik Informatika | Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/plugins/iCheck/square/blue.css">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url()."index.php"; ?>"><b>SI Kehadiran Dosen PSTI</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
     <?php
      if ($this->session->flashdata('pesan')!="") 
      { ?>
       <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $this->session->flashdata('pesan'); ?>
        </div>
      <?php }
      else
      {
      ?>
        <p class="login-box-msg">Sign in to start your session</p>
      <?php } ?>

    <form action="<?php echo base_url('Login/cekLogin'); ?>" method="post" name="myForm">
      <div class="form-group has-feedback">
        <div id="Username" style="color: red"></div>
        <input type="text" class="form-control" placeholder="Username" name="u" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <div id="password12" style="color: red"></div>
        <input type="password" class="form-control" placeholder="Password" name="p" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8"> </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()."assets"; ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()."assets"; ?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });


    $('#submit').click(function(){
       if( document.myForm.u.value == "" )
       {
          $('#Username').html("silahkan masukkan username Anda");
          document.myForm.pesan.focus() ;
       }
       else
       {
          $('#Username').html("");
       }

        if( document.myForm.p.value == "" )
       {
          $('#password12').html("silahkan masukkan password Anda");
          document.myForm.pesan.focus() ;
       }
       else
       {
          $('#password12').html("");
       }
  }); 
    
  </script>

</body>
</html>
