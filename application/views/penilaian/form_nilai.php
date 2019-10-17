  
  <?php $id_user= $this->session->userdata('id'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><?php echo $title; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <?php
          if ($this->session->flashdata('pesan')!="") 
          { ?>
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $this->session->flashdata('pesan'); ?>
            </div>
          <?php }
          ?> 

          <div class="box box-success">
            <div class="box-header">
              
              <h3 class="box-title">
              	<?php echo $title; ?>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

            	<div class="alert alert-info" role="alert">
      				  Silahkan masukkan tanggal awal dan dan tanggal alhir untuk memfilter data rekapan absensi.
      				</div>
              
              
              ini berisi chart
              - presentasi kehadiran
                
                - rata rata jam masuk
                - rata rata jam keluar 
                - rata rata jam keluar istirahat
                - rata rata jam masuk istirahat
            </div>
            <!-- /.box-body -->
          </div>




          <div class="box box-success">
            <div class="box-header">
              
              <h3 class="box-title">
                Form penilaian
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="alert alert-info" role="alert">
                Silahkan masukkan tanggal awal dan dan tanggal alhir untuk memfilter data rekapan absensi.
              </div>
              
              <form action="<?php echo base_url()."PenilaianDosen/do_nilai" ?>" method="POST" > 
                <div class="form-group row">
                  <label for="nik" class="col-sm-2 col-form-label">NIK </label>
                  <div class="col-sm-4">
                    <input type="text" required readonly class="form-control" id="nik" name="nik" value="<?= $data['nik'] ?>">
                  </div>

                  <label for="nama" class="col-sm-2 col-form-label">Nama  </label>
                  <div class="col-sm-4">
                    <input type="text" required readonly class="form-control" id="nama" name="nama" value="<?= $data['alias'] ?>">
                  </div> 
               </div>  

               <div class="form-group row">
                  
                  <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="keterangan" required ></textarea>
                  </div> 
               </div>     


              <div class="form-group row"> 
                  <div class="col-sm-12">
                    <input type="submit" name="Submit" class="btn btn-success btn-block">
                  </div>
               </div>     

              </form>
            </div>
            <!-- /.box-body -->
          </div>


          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
