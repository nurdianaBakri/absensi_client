  
  <?php $id_user= $this->session->userdata('id'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data User
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> Data User</a></li>
        <li><a href="#"><i class="fa fa-user active"></i>Import User</a></li>
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
              	Import User
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

            	<div class="alert alert-info" role="alert">
				  Silahkan ambil data user (pegawai PSTI) dari sistem absensi fingerprint, kemudian import data tersebut ke sini.
				</div>
              
              <form action="<?php echo base_url()."User/doImport" ?>" method="POST" >

              	<div class="form-group row">
				    <label for="file" class="col-sm-1 col-form-label">File </label>
				    <div class="col-sm-9">
				      <input type="file" readonly class="form-control-plaintext" id="file">
				    </div>
				    <div class="col-sm-2">
				      <input type="submit" name="Import" class="btn btn-success btn-block">
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
