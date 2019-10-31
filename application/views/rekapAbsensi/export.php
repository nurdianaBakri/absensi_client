  
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
            
              	  <div class="hasil_export" id="DivIdToPrint">

                    <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
                    <!-- Font Awesome -->
                    <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/font-awesome/css/font-awesome.min.css">
                    <!-- Ionicons -->
                    <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/Ionicons/css/ionicons.min.css">
                    <!-- DataTables -->
                    <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">                   

                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No.</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Status</th> 
                      </tr>
                      </thead>
                      <tbody>
                       <?php 
                       $no=1;  
                         foreach ($data as $key ) 
                          {   
                            ?>
                                <tr style=" background-color: #4a914e;">
                                  <td colspan="5"><?php echo "<b>Tanggal : ".$key['tanggal']."</b>"; ?></td>
                                </tr> 
                            <?php
                            foreach ($key['data_scan'] as $key2)
                            { 
                              ?>
                                <tr>
                                  <td><?php echo $no++; ?></td>
                                  <td><?php echo $key2['nik']; ?></td>
                                  <td><?php
    
                                    $this->db->where('nik', $key2['nik']);
                                    $user = $this->db->get('user')->row_array();
                                    echo $user['first_name']." ".$user['last_name'];?>
                                  </td>
                                  <td><?php echo $key2['waktu']; ?></td>
                                  <td><?php echo $key2['io_icon']." ".$key2['io_name']; ?></td>
                                </tr>
                            <?php 
                            }

                            $no=1;
                            
                         }  ?>
                      </tbody>
                    <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>NIP</th>
                        <th>nama</th>
                        <th>Waktu</th> 
                        <th>Status</th>  
                    </tr>
                    </tfoot>
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
  // $(document).ready(function(){
  //  var elem='DivIdToPrint';
    
  //   var mywindow = window.open('', 'PRINT', 'height=400,width=600');

  //   mywindow.document.write('<html><head><title>' + document.title  + '</title>');
  //   mywindow.document.write('</head><body >');
  //   mywindow.document.write(document.getElementById(elem).innerHTML);
  //   mywindow.document.write('</body></html>');

  //   mywindow.document.close(); 
  //   mywindow.focus();

  //   mywindow.print();
  //   mywindow.close();

  //   return true;

  // });
</script>