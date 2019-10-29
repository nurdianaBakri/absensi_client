  
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
        <li><a href="#"><i class="fa fa-user active"></i> <?php echo $title; ?></a></li>
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
            <div class="box-header">  </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form action="<?php echo base_url()."PenilaianDosen/getPenilaian" ?>" method="POST" >

                <div class="form-group row">
                  <label for="awal" class="col-sm-2 col-form-label">Nama Pegawai </label>
                  <div class="col-sm-3">

                    <select class="form-control" name="nik">
                       <option value="semua">Semua</option>
                      <?php foreach ($data as $key): ?>
                       <option value="<?= $key['nik'] ?>"><?= $key['alias'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <label for="akhir" class="col-sm-2 col-form-label">Masa </label>
                  <div class="col-sm-3">
                    <select class="form-control" name="masa">
                      <?php foreach ($tahunBulan as $key): ?>
                       <option value="<?= $key['tanggal_scan'] ?>"><?= $key['tanggal_scan'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <button type="submit" class="btn btn-success">Lihat Penilaian</button>
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
 