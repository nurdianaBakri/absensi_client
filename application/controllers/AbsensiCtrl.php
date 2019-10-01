<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AbsensiCtrl extends CI_Controller {

    var $API ="";
	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in') != TRUE){
            redirect("Login/index");
        }

        $this->API="http://nusapintar.com/kehadiran/index.php/absen/psti";
        $this->load->library('curl');  
    }

    function index()
    {
        $day_date=date('Y-m-d');
        $getallData['title'] = "Absen";
        $getallData['data'] = "";
        $data= $this->M_absensi->getAll($day_date);
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
        $this->load->view("absen/absen" ,$getallData);
        $this->load->view("include/footer");
    }

    function generate()
    {
       $ket_io_mode="";
        $balikan = array();
        $data = json_decode($this->curl->simple_get($this->API))->data;
        $updateTerakhir = json_decode($this->curl->simple_get($this->API))->updateTerakhir;
        foreach ($data as $key)
        {
            $balikan= array(
                'nama' => $key->first_name.$key->last_name, 
                'scan_time_awal' => $key->scan_time_awal, 
                'scan_time_akhir' => $key->scan_time_akhir, 
                'nik' => $key->nik, 
                'read' => 0, 
                'nim' => "0", 
                'io_mode' => $key->io_mode, 
                'tanggal_scan' => $key->tanggal_scan,
            );
            $this->db->insert('notif_absen',$balikan);
        }
        var_dump($balikan);
    }

   
}