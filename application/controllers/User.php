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

    public function profile($id_user)
    {
        $data = array();
        if ($this->session->userdata('id')!=$id_user) {
            $this->session->set_flashdata('pesan',"Anda tidak boleh mengakses data User lain");  
        }
        else
        {
            $where = array(
                'id_user' => $id_user, 
            ); 

           $hasil = $this->M_user->detail($where);
           if ($hasil->num_rows()>0)
           {
                $data['data'] = $hasil->row_array();
           }
           else
           {
            $this->session->set_flashdata('pesan',"User tidak di temukan");
           } 
        }

        $data['title'] = "Profile";
        $this->load->view("include/header",$data);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("user/detail" ,$data);
        $this->load->view("include/footer"); 
    }

    public function detail($id_user=null)
    {
        $data = array();
        $where = array(
            'id_user' => $id_user, 
        ); 

       $hasil = $this->M_user->detail($where);
       if ($hasil->num_rows()>0)
       {
            $data['data'] = $hasil->row_array();
       }
       else
       {
        $this->session->set_flashdata('pesan',"User tidak di temukan");
       }  

        $data['title'] = "Detail User";
        $this->load->view("include/header",$data);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("user/detail" ,$data);
        $this->load->view("include/footer"); 
    }

    public function hapus($id_user)
    {
        $where = array(
            'id_user' => $id_user, 
        );
       $hasil = $this->M_user->hapus($where);
       if ($hasil==true)
       {
            $this->session->set_flashdata('pesan',"Proses hapus user berasil");
       }
       else
       {
        $this->session->set_flashdata('pesan',"Proses hapus user gagal, silahkan coba kebali ");
       }
        redirect("User"); // Redirect ke halaman awal (ke controller siswa fungsi index)  
    }

    public function do_update()
    {
        $pesan="";
        $nik =$this->input->post('nik');
        $data = array(
            'nik' =>$nik, 
            'first_name' =>$this->input->post('first_name'), 
            'last_name' =>$this->input->post('last_name'), 
            'alias' =>$this->input->post('alias'), 
            'gender' =>$this->input->post('gender'), 
            'jenis_user' =>$this->input->post('jenis_user'), 
            'username' =>$this->input->post('username'),  
        );

        if ($this->input->post('password'))
        {
           $data['password'] = md5($this->input->post('password'));
        }

        // var_dump($_FILES["foto"]["error"]);

        if($_FILES["foto"]["error"] == 4)
        {
            $pesan.= "<li>".$_FILES["foto"]["error"]."</li>"; 
        }
        else
        {
            $upload = $this->doConfig($nik);
            if ($upload['berhasil']==TRUE)
            {
                $data['foto'] = $nik.".png";
                $pesan.= "<li>Proses update foto user berhasil </li>"; 
            }
            else
            { 
                $pesan.= "<li>".$upload['error']."</li>"; 
            }
        }
      
        $id_user = $this->input->post('id_user');
        $where = array('id_user' => $id_user );

        // var_dump($data);

        $hasil = $this->M_user->update($where,$data);
       if ($hasil==true)
       {
            $pesan.= "<li>Proses update user berasil</li>";  
       }
       else
       {
            $pesan.= "<li>Proses update user gagal, silahkan coba kebali </li>";  
       } 
        $this->session->set_flashdata('pesan',$pesan);
        redirect("User/detail/".$id_user); // Redirect ke halaman awal (ke controller siswa fungsi index)   
    }

    public function doConfig($file_name)
    {
        $data = array();
        $config['upload_path']        = 'assets/user/';
        $config['file_name']          = $file_name.".png";
        $config['allowed_types']      = 'jpg|png|jpeg';
        $config['overwrite'] = TRUE;

        $path = $_FILES['foto']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('foto'))
        {
            $data = array(
                'berhasil' =>FALSE ,
                'error' => $this->upload->display_errors(),
            );
        }
        else
        {
            $upload = $this->upload->data();
            $data = array(
                'berhasil' =>TRUE ,
                'error' => $upload,
            );
        }
        return $data;
    }




   
   
}