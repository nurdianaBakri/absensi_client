  
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
      				  Masukkan data Absensi hari ini (<?= date('d, M Y') ?>). Klik "Input absen" pada pegawai yang ingin di input data absennya 
      				</div>
              
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>NIK</th>
                    <th>Nama</th>
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
                          <td><?php echo $key['nik']; ?></td>
                          <td><?php
                              //PRINT NAMA SESUAI DENGAN NIK
                              $this->db->where('nik', $key['nik']);
                              $user = $this->db->get('user')->row_array();
                              echo $user['first_name']." ".$user['last_name'];?> 
                          </td>
                          <td>
                              <a href="<?php echo base_url()."AbsensiCtrl/formtambah/".$key['nik']?>" class="btn btn-success"><i class="fa fa-pencil"></i> Input Absen</a>
                          </td>
                        </tr>
                    <?php }  ?>
                  </tbody>
                <tfoot>
                <tr>
                     <th>No.</th>
                    <th>NIK</th>
                    <th>Nama</th>
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
