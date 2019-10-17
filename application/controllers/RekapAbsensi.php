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

        $data['data'] = $this->M_absensi->export($awal, $akhir);  
        $data['title'] = "Rekap absensi ".$awal." sampai dengan ".$akhir;

        $this->load->view("include/header",$data);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("rekapAbsensi/export" ,$data);
        $this->load->view("include/footer");
    }


   
   
}