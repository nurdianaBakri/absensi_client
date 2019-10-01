  
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
        <li><a href="#"><i class="fa fa-user active"></i> Data User</a></li>
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

                <a  href="<?php echo base_url()."User/form_impDosen"; ?>" class="btn btn-success"><i class="fa fa-download"></i>Import data user</a>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Jenis User</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>


                   <?php
                   $no=1;
                    foreach ($data as $key ) 
                    { 
                      ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $key['username']; ?></td>
                          <td><?php echo $key['nama']; ?></td>
                          <td><?php 
                          if ($key['jenis_user']==1) {
                            echo "Admin";
                          }
                          else if ($key['jenis_user']==2) {
                            echo "Kepala Prodi";
                          }
                          else
                          {
                            echo "Dosen";
                          }
                          ?></td>
                          <td>
                              <a href="<?php echo base_url()."User/reset/".$key['username']?>" class="btn btn-warning"><i class="fa fa-key"></i> Reset Password</a>
                          </td>
                        </tr>
                    <?php }  ?>
                  </tbody>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Jenis User</th>
                    <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
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

  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
