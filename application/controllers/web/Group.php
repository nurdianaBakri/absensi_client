<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

	var $API ="";
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/server/index.php/";
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->helper('url');

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
    }

    public function index()
    {
        $getallData['title'] = "Data Group";
    	$getallData['data']=$this->m_group->getall();
    	$this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("group/group" ,$getallData);
        $this->load->view("include/footer");
    }

    function generate()
    {
        $berhasil="";
        $data4 = array();
        //get data siswa

        $data = json_decode($this->curl->simple_get($this->API.'Mahasiswa?departement=552011'));
    	$i=1;

        foreach ($data as $key ) 
        {
        	if ($i<=3)
        	{
        		$angkatan = substr($key->nim, 0, 6);
        		if ($angkatan=="F1D016") 
        		{
        			//get mk yang di ambil sama mhs
		        	$TA = json_decode($this->curl->simple_get($this->API.'Tahun_Akademik'))->year->tahun;
		        	// $berhasil=$this->get_semesteran($key->nim);
		        	$data6 = json_decode($this->curl->simple_get($this->API.'Courses/index_get?nim='.$key->nim.'&year='.$TA));
			        foreach ($data6->course as $key2 ) 
					{
			    		//buat topik/tahun atau semester
			        	$this->db->where('kode_mk', $key2->kode_mk);
			        	$this->db->where('id_dosen', $key2->kode_dosen);
			        	$cek_topik = $this->db->get('topik');
			        	if ($cek_topik->num_rows()>0)
			        	{
			        			$id_topik = $cek_topik->row()->id_topik;
			        		 	$data2 = array(
					                'id_user' => $key->nim,
					                'id_topik' => $id_topik,
					            );
					            $berhasil = $this->insertGroup($data2);

					            if ($berhasil) {
					            	$data4 = array(
						            	'satus'=>"berhasil",
					            	);
					            }
					            else
					            {
					            	$data4 = array(
						            	'satus'=>"gagal",
					            	);
					            }

			        	}
			        	else
			        	{
			        		if ($key2->nama_mk=="Tugas Akhir I" || $key2->nama_mk=="Tugas Akhir II" ) 
			        		{}
			        		else
			        		{
			        			$data1 = array(
					            	'kode_mk'=> $key2->kode_mk,
					                'nama_topik' => $key2->nama_mk,
					                'semester' => $key2->semester,
					                'tahun' => substr($key2->tahun_akademik,0,4),
					                'id_dosen' => $key2->kode_dosen,
					            );

					            $berhasil = $this->db->insert("topik", $data1);
					            $id_topik = $this->db->query("select max(id_topik) as id_topik from topik")->row()->id_topik;

					            $data2 = array(
								    'id_user' => $key->nim,
					                'id_topik' => $id_topik,
								);

					            $berhasil = $this->insertGroup($data2);
					            $data23 =  array(
								    'id_user' => $key2->kode_dosen,
					                'id_topik' => $id_topik,
								);
					            $berhasil = $this->insertGroup($data23);

					            if ($berhasil) {
					            	$data4 = array(
						            	'satus'=>"berhasil",
					            	);
					            }
					            else
					            {
					            	$data4 = array(
						            	'satus'=>"gagal",
					            	);
					            }
			        		}
			        	}		
			        }

			        $i++;
        		}
        	}
        	else
        	{
	        	redirect('web/Group');
        	}
        	
        }

        
    }

    public function get_semesteran($nim)
    {
    	$data = json_decode($this->curl->simple_get($this->API.'credits/studentId/'.$nim));
        foreach ($data->creditsPerSubject as $key ) 
        {
    		//buat topik/tahun atau semester
        	$this->db->where('nama_topik', $key->nama_mk. " ".$key->tahun_akademik);
        	$cek_topik = $this->db->get('topik');
        	if ($cek_topik->num_rows()>0) {
        	}
        	else
        	{
        		$data = array(
	            	'id_topik'=>$key->kode_mk,
	                'nama_topik' => $key->nama_mk. " ".$key->tahun_akademik,
	            );
	            $berhasil = $this->db->insert("topik", $data);

	            $data2 = array(
	            	'id_topik'=>$key->kode_mk,
	                'id_user' => $nim,
	            );
	            $berhasil = $this->insertGroup($data2);

	            if ($berhasil) {
	            	return 1;
	            }
	            else
	            {
	            	return 0;
	            }
        	}
        }
    }

    public function insertGroup($data)
    {
        $berhasil = $this->db->insert("group", $data);
    	return $berhasil;
    }
}