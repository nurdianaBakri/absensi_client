  
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
                    echo "<form method='post' action='".base_url("InputRekapAbsensi/DoImport")."'>"; 

                    ?>
   

                    <?php 
                    echo "<table border='1' cellpadding='8' class='table table-striped'>
                     
                    <tr> 
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Tanggal</th> 
                      <th>Jam</th> 
                      <th>Status </th> 
                    </tr>";
                    
                    $numrow = 1;
                    $kosong = 0;
                    
                    // Lakukan perulangan dari data yang ada di excel
                    // $sheet adalah variabel yang dikirim dari controller
                    foreach($sheet as $row){ 
                      // Ambil data pada excel sesuai Kolom 
                      $nik = $row['A']; // Ambil data NIS 
                      $nama = $row['B']; // Ambil data NIS 
                      $tanggal = $row['C']; // Ambil data NIS  
                      $jam = $row['D']; // Ambil data NIS  
                      $status = $row['E']; // Ambil data NIS 

                      
                      // Cek jika semua data tidak diisi
                      if(empty($tanggal) && empty($jam) && empty($nik) && empty($nama) && empty($status) && empty($status) )
                        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                      
                      // Cek $numrow apakah lebih dari 1
                      // Artinya karena baris pertama adalah nama-nama kolom
                      // Jadi dilewat saja, tidak usah diimport
                      if($numrow > 1){
                        // Validasi apakah semua data telah diisi
                        $tanggal_td = ( ! empty($tanggal))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah  
                         $jam_td = ( ! empty($jam))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah  
                        $nik_td = ( ! empty($nik))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah 
                        $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah 
                        $status_td = ( ! empty($status))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah   
                        
                        // Jika salah satu data ada yang kosong
                        if(empty($tanggal) or empty($jam)  or empty($nik_td) or empty($nama_td) or empty($status_td) or empty($status) ){
                          $kosong++; // Tambah 1 variabel $kosong
                        }
                        
                        echo "<tr>";
                        echo "<td".$nik_td.">".$nik."</td>"; 
                        echo "<td".$nama_td.">".$nama."</td>"; 
                        echo "<td".$tanggal_td.">".$tanggal."</td>";
                        echo "<td".$jam_td.">".$jam."</td>";
                        echo "<td".$status_td.">".$status."</td>";  
                        echo "</tr>";
                      } 
                      $numrow++; // Tambah 1 setiap kali looping
                    }
                    
                    echo "</table>";
                     
                    echo "<hr>";
                    
                    // Buat sebuah tombol untuk mengimport data ke database
                    echo "<button type='submit' name='import' class='btn btn-success'>Import</button>";
                    echo "<a href='".base_url("InputRekapAbsensi")."'>Cancel</a>"; 
                    
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
