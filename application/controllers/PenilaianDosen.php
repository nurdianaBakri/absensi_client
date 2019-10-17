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

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("penilaian/penilaian" ,$getallData);
        $this->load->view("include/footer");
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