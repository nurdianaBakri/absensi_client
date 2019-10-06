
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_absensi extends CI_Model {

    public function getall($today)
    {
    	// $this->db->where('deleted',0);
        $this->db->like('tanggal_scan',$today);
    	$data =$this->db->get("absensi");
    	// $data =$this->db->query("SELECT DISTINCT(nik) as nik FROM absensi WHERE tanggal_scan like '%$today%'");
		return $data;
    }

    // Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('fileName')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($tabel, $data){
		$this->db->insert_batch($tabel, $data);
	}

	public function insert($data)
	{
		return $this->db->insert('absensi',$data);
	}

	



}