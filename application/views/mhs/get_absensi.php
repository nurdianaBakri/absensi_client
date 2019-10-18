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
                            </td>
                            <td><?php 
                              $this->db->where('nik', $key['nik']);
                              $user = $this->db->get('user')->row_array();
                              echo $user['first_name']." ".$user['last_name'];?>
                            </td>
                            <td><?php echo $key['waktu']; ?></td>
                            <td><?php echo $key['io_icon']." ".$key['io_name']; ?></td>
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
                </tr>
                </tfoot>
              </table>