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

   
   
}