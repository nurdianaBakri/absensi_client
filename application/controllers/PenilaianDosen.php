<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenilaianDosen extends CI_Controller {

    var $API ="";
	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in') != TRUE){
            redirect("Login/index");
        }
    }

    function index()
    {
        $getallData['title'] = "Penilaian Dosen";
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

        //get bulan dan tahun absensi
        $ThnBulan = $this->M_Penilaian->getTahunDanBulan();
        if ($ThnBulan->num_rows()>0) 
        {
            $getallData['tahunBulan']=$ThnBulan->result_array();
        }
        else
        {
            $getallData['tahunBulan'] = array();
        }

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("penilaian/form_nilai2" ,$getallData); 
        $this->load->view("include/footer");
    }

     public function getPenilaian()
    {
        $masa = $this->input->post('masa');  
        $data['title'] = "REKAP KEHADIRAN DOSEN";
        $data['title_rekap'] = "REKAP KEHADIRAN DOSEN TEKNIK INFORMATIKA UNRAM BULAN ".substr($masa, 5)." 2019";
        $nik = $this->input->post('nik');
        
        //get data penilaian berdasarkan nik dan masa 
        $data['data'] = $this->M_Penilaian->getPenilaian($nik,$masa);

        $this->load->view("include/header",$data);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("penilaian/penilaian2" ,$data); 
        $this->load->view("include/footer");
          
        // var_dump($data); 
    }
 
    function nilai($nik)
    {
        $getallData['title'] = "Form Penilaian Dosen ".$nik;
        $where = array('nik' => $nik, );

        $data= $this->M_user->detail($where);
        if ($data->num_rows()>0) 
        {
            $getallData['data']=$data->row_array();
        }
        else
        {
            $getallData['data'] = array();
        }

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("penilaian/form_nilai" ,$getallData);
        $this->load->view("include/footer");
    }

    function detail($nik)
    {
        $getallData['title'] = "Form Penilaian Dosen ".$nik;
        $where = array('nik' => $nik, );

        $data= $this->M_user->detail($where);
        if ($data->num_rows()>0) 
        {
            $getallData['data']=$data->row_array();
        }
        else
        {
            $getallData['data'] = array();
        }

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("penilaian/form_nilai" ,$getallData);
        $this->load->view("include/footer");
    }

    public function do_nilai()
    {
        $nik =$this->input->post('nik');
        $keterangan =$this->input->post('keterangan');

        $data = array(
            'nik' => $nik, 
            'keterangan' => $keterangan, 
        );

        $cek  = $this->M_Penilaian->insert($data);
        if ($cek==true)
        {
            $this->session->set_flashdata('pesan',"Proses input nilai berhasil ");
        }
        else
        {
            $this->session->set_flashdata('pesan',"Proses input nilai gagal ");
        }
        redirect('PenilaianDosen/nilai/'.$nik);
    }

   
   
}