  
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
        <li><a href="#"><i class="fa fa-user active"></i> Detail</a></li>
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
              	Detail User
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body"> 
             
              <form action="<?php echo base_url()."User/do_update" ?>" method="POST" enctype="multipart/form-data" > 

                  <center>
                    <?php 
                      $img =base_url()."assets/user/icon_user.png";
                      if ($data['foto']!=null)
                      {
                         $img =base_url()."assets/user/".$data['foto'];
                      }
                    ?>
                    <img src="<?= $img; ?>" style="border:3px solid green" width="250px" height="auto">
                  </center>
                  <br>

              	<div class="form-group row">

                  <input type="hidden"  id="id_user" value="<?= $data['id_user'] ?>" name="id_user">

      				    <label for="nik" class="col-sm-2  col-form-label">NIK </label>
      				    <div class="col-sm-4">
      				      <input type="text" class="form-control" id="nik" value="<?= $data['nik'] ?>" name="nik">
      				    </div>
      				    <label for="first_name" class="col-sm-2  col-form-label">Nama Depan </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="first_name" value="<?= $data['first_name'] ?>" name="first_name">
                  </div>
      				  </div>	

                <div class="form-group row">
                  <label for="last_name" class="col-sm-2">Last Name </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="last_name" value="<?= $data['last_name'] ?>" name="last_name">
                  </div>
                  <label for="alias" class="col-sm-2">Alias </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="alias" value="<?= $data['alias'] ?>" name="alias">
                  </div>
                </div>  

                <div class="form-group row">
                  <label for="gender" class="col-sm-2">Gender </label>
                  <div class="col-sm-4">
                    <select  name="gender" class="form-control"  >
                      <option value="1" <?php if($data['gender']=="1"){ echo "selected";} ?>> Wanita</option>
                      <option value="0" <?php if($data['gender']=="0"){ echo "selected";} ?>> Laki - Laki</option>
                    </select>
                  </div>
                  <label for="jenis_user" class="col-sm-2">Jenis user </label>
                  <div class="col-sm-4">
                    <select   class="form-control" name="jenis_user">
                      <option value="2" <?php if($data['jenis_user']=="2"){ echo "selected";} ?>> Kepala Prodi</option>
                      <option value="3" <?php if($data['jenis_user']=="3"){ echo "selected";} ?>> Dosen</option>
                      <option value="1" <?php if($data['jenis_user']=="1"){ echo "selected";} ?>> Admin</option>
                    </select>
                  </div>
                </div>  		

                 <div class="form-group row">
                  <label for="username" class="col-sm-2">Username </label>
                  <div class="col-sm-4">
                     <input type="text" class="form-control" id="username" value="<?= $data['username'] ?>" name="username">
                  </div> 

                   <label for="password" class="col-sm-2">Password (Kosongkan jika tidak ingin merubah password) </label>
                  <div class="col-sm-4">
                     <input type="text" class="form-control" id="password" name="password">
                  </div>
                </div> 

                <div class="form-group row">
                   <label for="foto" class="col-sm-2">Foto (Kosongkan jika tidak ingin merubah foto, *max : 2MB) </label>
                  <div class="col-sm-4">
                     <input type="file" class="form-control" id="foto" name="foto">
                  </div>
                </div>   

                 <div class="form-group row">
                   
                  <div class="col-sm-12">
                     <button type="submit"  class="btn btn-success btn-block"> Update</button>
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
