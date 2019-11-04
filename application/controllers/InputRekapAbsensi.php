<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InputRekapAbsensi extends CI_Controller {

    var $API ="";
    private $filename = "inportdataabsen"; // Kita tentukan nama filenya

	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in') != TRUE){
            redirect("Login/index");
        }
    }

    function index()
    {
        $getallData['title'] = "Input Rekap Absensi"; 

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("inputRekapAbsensi/form_filter" ,$getallData);
        $this->load->view("include/footer");
    }

    public function cek_file()
    {
        $data = array();
        $upload = $this->M_absensi->upload_file($this->filename); 

        if($upload['result'] == "success"){ // Jika proses upload sukses
            // Load plugin PHPExcel nya
            include APPPATH.'third_party/PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            // $excelreader = PHPExcel_IOFactory::createReader('Excel5');
            $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
            // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
            $data['sheet'] = $sheet;  
            
        }else{ // Jika proses upload gagal
            $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan  
        }

        $data['title']="Perview data Rekap absensi";
        $this->load->view("include/header",$data);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view('inputRekapAbsensi/cek_file',$data);
        $this->load->view("include/footer");

    }

     public function DoImport(){
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
        $data_input = array(); 
        
        $numrow = 1;      

        foreach($sheet as $row){
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if(($numrow > 1) && $row['B']!=null){ 

                //cek apaka nik ==null
                // if ($row['B']==null || $row['B']=="")
                // {
                //     # cek nik dengan nama yg sama 
                //     $this->db->where('');
                // }

                $io_mode=0;
                $io_mode_string = $row['G'];

                $this->db->where('io_name',$io_mode_string);
                $this->db->select('io_mode');
                $io_mode = $this->db->get('mode')->row()->io_mode; 
                

                //sesuaikan FORMAT TANGGAL 
                //tahun/bulan/hari
                $tahun=substr($row['D'], 6,4);
                $bulan=substr($row['D'], 3,2);
                $hari=substr($row['D'], 0,2);

                // Kita push (add) array data ke variabel data
                array_push($data_input, array(
                    // 'nis'=>$row['A'], // Insert data nis dari kolom A di excel
                    'nik'=>$row['B'], // Insert data nama dari kolom B di excel 
                    'io_mode'=>$io_mode, // Insert data alamat dari kolom D di excel
                    'tanggal_scan'=>$tahun."-".$bulan."-".$hari." ".$row['E'], // Insert data alamat dari kolom D di excel
                ));     
            }
            
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
        $cek1 = $this->M_absensi->insert_multiple("absensi", $data_input); 

        // var_dump($data_input);

        $this->session->set_flashdata('pesan',"Proses import data selesai ");
        
        redirect("AbsensiCtrl"); // Redirect ke halaman awal (ke controller siswa fungsi index)  
    }

   
   
}