<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
		//header("Content-type:application/json");
    }

    public function index()
	{
        $day_date=date('Y-m-d'); 
		$getallData['data']= $this->M_absensi->getAll($day_date);
		$this->load->view('mhs/view_absen',$getallData);
	}
 
	public function login()
	{
		$this->load->view('login/login');
	}

	public function cekLogin()
	{
		$username = $this->input->post('u');
		$password = $this->input->post('p');

		$cek = $this->M_login->ceklogin($username,$password);
		// var_dump($cek);
		if ($cek['username']==="") 
		{
            $this->session->set_flashdata('pesan', 'Username dan password tidak cocok, silahkan coba kembali');
			redirect('Login/index');
		}
		else
		{
			$this->session->set_userdata($cek);
			$id_user = $this->session->userdata('id');
			if ($cek['logged_in']!=FALSE) 
			{
				redirect('AbsensiCtrl');
			}
			else{
				$this->session->set_flashdata('pesan', 'anda tidak dapat mengakses aplikasi web, silahkan akses aplikasi mobile');
				redirect('Login/index');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('jenis_user');
		$this->session->unset_userdata('alias');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('logged_in');

		redirect('Login/index');
	}

	public function getAbsensi()
	{
		$day_date=date('Y-m-d'); 
		$getallData['data']= $this->M_absensi->getAll($day_date);
		$this->load->view('mhs/get_absensi',$getallData);
	}

}
