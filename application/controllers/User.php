<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

    public function doImport()
    {
        echo "module sedand di buat";
    }

   
   
}