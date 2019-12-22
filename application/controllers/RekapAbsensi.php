<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapAbsensi extends CI_Controller {

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
        $getallData['title'] = "Rekap Absensi"; 

        if ($this->session->userdata('jenis_user')!=1 || $this->session->userdata('jenis_user')!="1") {
            $nik = $this->session->userdata('nik');
            $this->db->where('nik',$nik);
            $this->db->select('nik, last_name, first_name');
            $data[]= $this->db->get('user')->row_array();
            $getallData['pegawai'] = $data;
        }
        else
        {
            $this->db->select('nik, last_name, first_name');
            $getallData['pegawai'] = $this->db->get('user')->result_array();
        }            

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("rekapAbsensi/form_filter" ,$getallData);
        $this->load->view("include/footer");
    }

    public function export()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $nik = $this->input->post('nik');

        $data['data'] = $this->M_absensi->export($awal, $akhir, $nik); 
        $data['last_q'] =$this->db->last_query(); 
        $data['title'] = "Rekap absensi ".$awal." sampai dengan ".$akhir;

        $this->load->view("include/header",$data);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("rekapAbsensi/export" ,$data);
        $this->load->view("include/footer");
    }


   
   
}