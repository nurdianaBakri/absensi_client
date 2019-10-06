  
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


          <div class="box">
            <div class="box-header">
              
              <h3 class="box-title">
              	<?php echo $title; ?>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

            	<div class="alert alert-info" role="alert">
      				  Masukkan data Absensi hari ini (<?= date('d, M Y') ?>)
      				</div>
              
              <form action="<?php echo base_url()."AbsensiCtrl/doTambah" ?>" method="POST" >

              	<div class="form-group row">
      				    <label for="nik" class="col-sm-1 col-form-label">NIK </label>
      				    <div class="col-sm-3">
      				      <input type="text" class="form-control" id="nik" value="<?= $data['nik'] ?>" name="nik" readonly>
      				    </div>

      				    <label for="alias" class="col-sm-1 col-form-label">Nama </label>
      				    <div class="col-sm-3">
      				      <input type="text" class="form-control" id="alias" value="<?= $data['alias'] ?>" name="alias" readonly>
      				    </div>

                   <label for="akhir" class="col-sm-1 col-form-label">Status </label>
                  <div class="col-sm-3">
                    <select class="form-control" name="status">
                      <?php foreach ($mode as $key ): ?>
                        <option value="<?= $key['io_mode']; ?>"><?= $key['io_name'] ?></option>
                      <?php endforeach ?> 
                    </select>
                  </div>      				   
      				 </div>	

               <div class="row">
                  <div class="col-sm-12">
                    <input type="submit" name="Simpan" value="Simpan" class="btn btn-success btn-block">
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
