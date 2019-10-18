<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Waktu</th>
                    <th>Status</th> 
                     <?php if ($this->session->userdata('jenis_user')=="1"): ?>
                      <th>Aksi</th>  
                    <?php endif ?>
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
                            <td>
                              <center>
                                <?php 
                                  $img =base_url()."assets/user/icon_user.png";
                                  if ($key['foto']!=null)
                                  {
                                     $img =base_url()."assets/user/".$key['foto'];
                                  }
                                ?>
                                <img src="<?= $img; ?>" style="border:3px solid green" width="100px" height="auto"> <br>
                                <?php echo $key['nik']; ?></td>
                              </center> 
                            <td>
                              <?php
                              //PRINT NAMA SESUAI DENGAN NIK
                              $this->db->where('nik', $key['nik']);
                              $user = $this->db->get('user')->row_array();
                              echo $user['first_name']." ".$user['last_name'];?>
                            </td>
                            <td><?php echo $key['waktu']; ?></td>
                            <td><?php echo $key['io_icon']."  ".$key['io_name']; ?></td>

                            <?php if ($this->session->userdata('jenis_user')=="1"): ?>
                                <td>
                                  <a target="_blank" href="<?php echo base_url()."AbsensiCtrl/formtambah/".$key['nik']; ?>" class="btn btn-success"><i class="fa fa-download"></i> Input Absen</a>
                                </td>
                            <?php endif ?>
                            
                          </tr>
                      <?php 
                     }  ?>
                  </tbody>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>NIP</th>
                    <th>nama</th>
                    <th>Waktu</th> 
                    <th>Status</th>  
                    <?php if ($this->session->userdata('jenis_user')=="1"): ?>
                      <th>Aksi</th>  
                    <?php endif ?>

                </tr>
                </tfoot>
              </table>

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
