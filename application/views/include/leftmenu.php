<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <?php $id_user= $this->session->userdata('id'); ?>
      <?php $level= $this->session->userdata('level'); ?> 

      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()."assets"; ?>/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>

        <?php if ($this->session->userdata('jenis_user')=="1")
        { ?>
        <li>
          <a href="<?php echo base_url()."User"; ?>">
            <i class="fa fa-group"></i><span>Kelola User</span>
          </a>
        </li> 
      <?php } ?>

         <li>
          <a href="<?php echo base_url()."AbsensiCtrl"; ?>">
            <i class="fa fa-book"></i><span>Absensi</span>
          </a>
        </li>        
        <li>
          <a href="<?php echo base_url()."RekapAbsensi"; ?>">
            <i class="fa fa-archive"></i><span>Rekap Absensi</span>
          </a>
        </li>
        <?php 
        if ($this->session->userdata('jenis_user')=="1")
        { ?>

         <li>
            <a href="<?php echo base_url()."InputRekapAbsensi"; ?>">
              <i class="fa fa-archive"></i><span>Input Rekap Absensi</span>
            </a>
          </li> 
        <?php } ?> 

        <?php 
        if ($this->session->userdata('jenis_user')=="2")
        { ?>  
        
          <li>
          <a href="<?php echo base_url()."PenilaianDosen"; ?>">
            <i class="fa fa-area-chart"></i><span>Penilaian Dosen</span>
          </a>
        </li>
        <?php } ?>

        
         <li>
          <a href="<?php echo base_url()."User/profile/".$this->session->userdata('id'); ?>">
            <i class="fa fa-user"></i><span>Profile</span>
          </a>
        </li>
          <li>
          <a href="<?php echo base_url()."Login/logout" ?>">
            <i class="fa fa-bell-o"></i><span>Logout</span>
          </a>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>