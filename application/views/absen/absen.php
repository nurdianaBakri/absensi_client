  
  <?php $id_user= $this->session->userdata('id'); ?>
  <div class="content-wrapper">
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
                <a target="_blank" href="<?php echo base_url()."AbsensiCtrl/dataAwal"; ?>" class="btn btn-success"><i class="fa fa-download"></i> Input Absen</a>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="alert alert-info" role="alert">
                Informasi Absensi pegawai Program Studi teknik informatika hari ini (<?= date('d, M Y') ?>)
              </div>

              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Status Absensi</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                   $no=1;
                   if (sizeof($data)>0) 
                   {
                     foreach ($data as $key ) 
                      { 
                        ?>
                          <tr>
                            <td><?php echo "  ".$no++; ?></td>
                            <td><?php echo "  ".$key['nik']; ?></td>
                            <td><?php

                            // var_dump($key['nik']);

                              //PRINT NAMA SESUAI DENGAN NIK
                              $this->db->where('nik', $key['nik']);
                              $user = $this->db->get('user')->row_array();
                              echo $user['first_name']." ".$user['last_name'];?></td>
                            <td>
                                <a href="<?php echo base_url()."AbsensiCtrl/detail/".$key['id_absen']?>" class="btn btn-success"><i class="fa fa-list"></i> Detail</a>
                            </td>
                          </tr>
                      <?php 
                     }
                  }  ?>
                  </tbody>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>NIP</th>
                    <th>nama</th>
                    <th>Status Absensi</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
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
