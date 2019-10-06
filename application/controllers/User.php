<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    var $API ="";
    private $filename = "inportdatauser"; // Kita tentukan nama filenya

	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in') != TRUE){
            redirect("Login/index");
        }
    }

    function index()
    {
        $getallData['title'] = "Kelola User";
        $getallData['data'] = "";
        $data= $this->M_user->getAll();
        if ($data->num_rows()>0) 
        {
            $getallData['data']=$data->result_array();
        }
        else
        {
            $getallData['data'] = array();
        }

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("user/user" ,$getallData);
        $this->load->view("include/footer");
    }

    public function form_impDosen()
    {
        $getallData['title'] = "Kelola User";
        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("user/form_impDosen" ,$getallData);
        $this->load->view("include/footer");
    }

    public function cek_file()
    {
        $data = array();
        $upload = $this->M_user->upload_file($this->filename); 

        if($upload['result'] == "success"){ // Jika proses upload sukses
            // Load plugin PHPExcel nya
            include APPPATH.'third_party/PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
            // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
            $data['sheet'] = $sheet;  
            
        }else{ // Jika proses upload gagal
            $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan  
        }

        $data['title']="Perview data User";
        $this->load->view("include/header",$data);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view('user/cek_file',$data);
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
            if(($numrow > 1) && $row['A']!=null){  
                
                $gender = 0;
                if ($row['D']=="Laki - Laki") {
                    $gender = 0;
                }
                else
                {
                    $gender=1;
                }

                if ($row['H']=="Dosen") {
                    $jenis_user = 3;
                }
                elseif ($row['H']=="Admin") {
                    $jenis_user = 1;
                }
                else
                {
                    $jenis_user=2;
                }

                // Kita push (add) array data ke variabel data
                array_push($data_input, array(
                    // 'nis'=>$row['A'], // Insert data nis dari kolom A di excel
                    'nik'=>$row['A'], // Insert data nama dari kolom B di excel 
                    'first_name'=>$row['B'], // Insert data alamat dari kolom D di excel
                    'last_name'=>$row['C'], // Insert data alamat dari kolom D di excel
                    'gender'=>$gender, // Insert data alamat dari kolom D di excel
                    'alias'=>$row['E'], // Insert data alamat dari kolom D di excel
                    'username'=>$row['F'], // Insert data alamat dari kolom D di excel
                    'password'=>md5($row['G']), // Insert data alamat dari kolom D di excel
                    'jenis_user'=>$jenis_user, // Insert data alamat dari kolom D di excel
                ));     
            }            
            $numrow++; // Tambah 1 setiap kali looping
        }

        // var_dump($data_input);

        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
        $cek1 = $this->M_user->insert_multiple("user", $data_input); 

        $this->session->set_flashdata('pesan',"Proses import data selesai ");
        
        redirect("User"); // Redirect ke halaman awal (ke controller siswa fungsi index)  
    }

    public function detail($kd_user=null)
    {
        echo "module sedand di buat";
        # code...
    }

   
   
}