    <?php $id_user= $this->session->userdata('id'); ?>
    <?php $level_user= $this->session->userdata('level'); ?>
 
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()."index.php/web/Suratmasuk/webGetAll/".$id_user; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SI</b>Absensi</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI-Absensi</b>PSTI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </nav>
  </header>