  
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
              
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="alert alert-info" role="alert">
                Informasi Absensi pegawai Program Studi teknik informatika hari ini (<?= date('d, M Y') ?>)
              </div>

              <div class="result"></div>

              

            </div>
          </div>
        </div>
      </div>
    </section>
  </div> 

  <script>
  (function worker() {
    $.ajax({
      url: "<?= base_url()."AbsensiCtrl/getAbsensi" ?>", 
      success: function(data) {
        // console.log(data);
        $('.result').html(data);
      },
      complete: function() {
        // Schedule the next request when the current one's complete
        setTimeout(worker, 50000);
      }
    });
  })();
     
  </script> 
