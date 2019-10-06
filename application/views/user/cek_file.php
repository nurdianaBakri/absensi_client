  
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

            	<div class="alert alert-warning" role="alert">
      				  Berikut adalah perview data yang ingin anda import
      				</div>

              <?php  
                    if(isset($upload_error)){ // Jika proses upload gagal
                      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
                      die; // stop skrip
                    }
                    
                    // Buat sebuah tag form untuk proses import data ke database
                    echo "<form method='post' action='".base_url("User/DoImport")."'>"; 

                    ?>
   

                    <?php 
                    echo "<table border='1' cellpadding='8' class='table table-striped'>
                     
                    <tr> 
                      <th>NIK</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Gender</th>
                      <th>Alias</th>
                      <th>Username</th> 
                      <th>Password</th> 
                      <th>Jenis User </th> 
                    </tr>";
                    
                    $numrow = 1;
                    $kosong = 0;
                    
                    // Lakukan perulangan dari data yang ada di excel
                    // $sheet adalah variabel yang dikirim dari controller
                    foreach($sheet as $row){ 
                      // Ambil data pada excel sesuai Kolom 
                      $nik = $row['A']; // Ambil data NIS \
                      $first_name = $row['B']; // Ambil data NIS  
                      $last_name = $row['C']; // Ambil data NIS  
                      $gender = $row['D']; // Ambil data NIS  
                      $alias = $row['E']; // Ambil data NIS  
                      $username = $row['F']; // Ambil data NIS  
                      $password = $row['G']; // Ambil data NIS  
                      $jenis_user = $row['H']; // Ambil data NIS 

                      
                      // Cek jika semua data tidak diisi
                      if(empty($first_name) && empty($last_name) && empty($gender) && empty($alias) && empty($password) && empty($nik) && empty($username) && empty($jenis_user) )
                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                      
                      // Cek $numrow apakah lebih dari 1
                      // Artinya karena baris pertama adalah nama-nama kolom
                      // Jadi dilewat saja, tidak usah diimport
                      if($numrow > 1){
                        // Validasi apakah semua data telah diisi
                        $first_name_td = ( ! empty($first_name))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah  

                         $last_name_td = ( ! empty($last_name))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah  

                          $gender_td = ( ! empty($gender))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah  

                           $alias_td = ( ! empty($alias))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah  
                         $password_td = ( ! empty($password))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah  
                        $nik_td = ( ! empty($nik))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah 

                          $username_td = ( ! empty($username))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah 
                         
                        $jenis_user_td = ( ! empty($jenis_user))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah   
                        
                        // Jika salah satu data ada yang kosong
                        if(empty($first_name) or empty($last_name) or empty($gender) or empty($alias) or empty($username) or empty($password)  or empty($nik_td)   or empty($jenis_user) ){
                          $kosong++; // Tambah 1 variabel $kosong
                        }
                        
                        echo "<tr>";
                        echo "<td".$nik_td.">".$nik."</td>"; 
                        echo "<td".$first_name_td.">".$first_name."</td>";
                        echo "<td".$last_name_td.">".$last_name."</td>"; 
                        echo "<td".$gender_td.">".$gender."</td>"; 
                        echo "<td".$alias_td.">".$alias."</td>"; 
                        echo "<td".$username_td.">".$username."</td>";
                        echo "<td".$password_td.">".$password."</td>";
                        echo "<td".$jenis_user_td.">".$jenis_user."</td>";  
                        echo "</tr>";
                      } 
                      $numrow++; // Tambah 1 setiap kali looping
                    }
                    
                    echo "</table>";
                     
                    echo "<hr>";
                    
                    // Buat sebuah tombol untuk mengimport data ke database
                    echo "<button type='submit' name='import' class='btn btn-success'>Import</button>";
                    echo "<a href='".base_url("User")."'>Cancel</a>"; 
                    
                    echo "</form>";  

                    ?> 

              
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
