  
  <?php $id_user= $this->session->userdata('id'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Group
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
                <a  href="<?php echo base_url()."index.php/web/Group/generate"; ?>" class="btn btn-primary"><i class="fa fa-refresh"></i> data group</a>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode MK</th>
                    <th>Nama Topik</th>
                    <th>Semester</th>
                    <th>Tahun</th>
                    <th>Kode Dosen</th>
                    <th>Nama Dosen</th>
                  </tr>
                  </thead>
                  <tbody>


                   <?php
                   $no=1;
                    foreach ($data as $key ) 
                    { 
                      ?>
                        <tr>
                          <td><?php echo "  ".$no++; ?></td>
                          <td><?php echo "  ".$key->kode_mk; ?></td>
                          <td><?php echo "  ".$key->nama_topik; ?></td>
                          <td><?php echo "  ".$key->semester; ?></td>
                          <td><?php echo "  ".$key->tahun; ?></td>
                          <td><?php echo "  ".$key->id_dosen; ?></td>
                          <td><?php 
                              $this->db->where('username',$key->id_dosen);
                              $dosen = $this->db->get('user');
                              if ($dosen->num_rows()==1)
                              {
                                echo $dosen->row()->nama;
                              }
                              else
                              {
                                echo "MKDU";
                              }
                          ?></td>
                          <!-- <td>
                            <a href="<?php echo base_url()."index.php/web/Group/detail/".$key->kode_mk."/".$key->semester?>" class="btn btn-primary"><i class="fa fa-search"></i>Detail</a>
                          </td> -->
                        </tr>
                    <?php }  ?>
                  </tbody>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Level</th>
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
