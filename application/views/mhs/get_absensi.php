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
                            <td><?php echo $key['nik']; ?></td>
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