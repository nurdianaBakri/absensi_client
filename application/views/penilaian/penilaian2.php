  
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
              	<?php echo $title_rekap; ?>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body"> 
            
              	  <div class="hasil_export" id="DivIdToPrint">

                    <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
                    <!-- Font Awesome -->
                    <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/font-awesome/css/font-awesome.min.css">
                    <!-- Ionicons -->
                    <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/Ionicons/css/ionicons.min.css">
                    <!-- DataTables -->
                    <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

                    <?php
                    $link=""; 
                    if (sizeof($data)>1)
                    {
                      # semua
                      $link = "PenilaianDosen/export/semua/".$data[0]['tahun']."-".$data[0]['bulan'];
                    }
                    else
                    {
                      $link = "PenilaianDosen/export/".$data[0]['nik']."/".$data[0]['tahun']."-".$data[0]['bulan'];
                    }
                    ?>

                    <a class="btn btn-success" href="<?= base_url().$link; ?>">Export ke Microsoft Excel</a>

                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No.</th>
                        <th>NIK</th> 
                        <th>Nama</th> 
                        <th>Gol</th> 
                        <th>Jumlah Hari Kerja</th> 
                        <th>H</th> 
                        <th>S</th> 
                        <th>I</th> 
                        <th>C</th> 
                        <th>TK</th> 
                        <th>T</th> 
                        <th>%</th> 
                        <th>Nilai</th> 
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
                                  <td><?php echo $key['nama']; ?></td> 
                                  <td>-</td> 
                                  <td><?php echo $key['jml_hari_kerja']; ?></td> 
                                  <td><?php echo $key['hadir']; ?></td> 
                                  <td><?php echo $key['sakit']; ?></td> 
                                  <td><?php echo $key['izin']; ?></td> 
                                  <td><?php echo $key['cuti']; ?></td> 
                                  <td><?php echo $key['tanpa_ket']; ?></td> 
                                  <td><?php echo $key['tugas_dinas']; ?></td> 
                                  <td><?php echo $key['persen']; ?></td> 
                                  <td><?php  echo $key['nilai']; ?></td> 
                                </tr>
                            <?php   
                         }  ?>
                      </tbody> 
                  </table>
                  </div>

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

<script type="text/javascript">
 
</script>