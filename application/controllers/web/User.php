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

        $this->API="https://sia.unram.ac.id/_api/";
        $this->load->library('curl');  
    }

    function getAll()
    {
            $getallData['title'] = "User";
            $getallData['data'] = $this->M_user->getAll();

            $this->load->view("include/header",$getallData);
            $this->load->view("include/topmenu");
            $this->load->view("include/leftmenu" );
            $this->load->view("user/user" ,$getallData);
            $this->load->view("include/footer");
    }

    public function refresh_data_mhs()
    {
        $berhasil="";
        $data = json_decode($this->curl->simple_get($this->API.'students/dept/552011'));
        foreach ($data->students as $key ) 
        {

            $angkatan = substr($key->NIM, 0, 6);
            if ($angkatan=="F1D016") 
            {
                $data_input = array(
                    'username' => $key->NIM,
                    'nama' => $key->nama,
                    'password'=>md5($key->NIM),
                    'level'=> 'mahasiswa',
                );
                //tambah data mahasiswa
                $berhasil = $this->M_user->refresh_data_mhs($key->NIM, $data_input);
            }
        }
        redirect('web/User/getAll');
    }

    public function refresh_data_dsn()
    {
        $berhasil="";
        $data = json_decode($this->curl->simple_get($this->API.'lecturers/deptId/552011'));
 
        foreach ($data->lecturer as $key ) 
        {

            $username = "";

            if ($key->NIP=="")
            {
                $username=$key->kode;
            }
            else
            {
                $username = $key->NIP;

            }

            $data_input = array(
                'username' => $username,
                'nama' => $key->nama,
                'password'=>md5($username),
                'level'=> 'dosen',
            );

            //tambah data dosen
            $berhasil = $this->M_user->refresh_data_dsn($username, $data_input);
        }

        redirect('web/User/getAll');
    }


    public function reset($username)
    {
        $data= $this->M_user->reset($username);
        if ($data['sukses']==1) 
        {
            $this->session->set_flashdata('pesan', 'berhasil mereset password, berikut adalah password baru : '.$data['password']);
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Gagal mereset password, silahkan coba kembali');
        }
        redirect('web/User/getAll');
    }
   
}