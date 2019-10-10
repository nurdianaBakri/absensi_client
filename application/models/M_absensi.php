
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_absensi extends CI_Model {

    // SELECT MAX(id_absen) as id_absen, nik, io_mode, id_absen  FROM absensi  where tanggal_scan like '$today%' AND nik='$nik'

    public function getall($today)
    {
    	$data2 = array();
    	$io_name="";
    	$this->db->where('deleted',0);
    	$user = $this->db->get('user')->result_array();
    	foreach ($user as $key ) {
    		$nik = $key['nik']; 
    		// $hasil2 =$this->db->query("SELECT MAX(id_absen) as id_absen FROM absensi  where nik='$nik'")->row_array(); 

      //       $id_absen=$hasil2['id_absen'];  

            $hasil =$this->db->query("SELECT nik, io_mode, tanggal_scan, id_absen FROM absensi  where id_absen=(SELECT MAX(id_absen) as id_absen FROM absensi  where nik='$nik')")->row_array(); 

    		$io_mode=$hasil['io_mode'];  
    		if ($io_mode=="0" || $io_mode=="1" || $io_mode=="2" || $io_mode=="3" || $io_mode=="4" || $io_mode=="5" || $io_mode=="6")
    		{
    			$io_name =$this->db->query("SELECT io_name from mode where io_mode=$io_mode")->row_array()['io_name'];
    		}
    		else if ($io_mode==null)
    		{
    			$io_name="-";
    		}
    		else
    		{
    			$io_name="-";
    		} 

    		$data['nama'] =$key['alias'];
    		$data['nik'] =$key['nik'];
    		$data['io_mode'] =$hasil['io_mode']; 
    		$data['io_name'] =$io_name; 
            $data['id_absen'] =$hasil['id_absen']; 
    		$data['waktu'] = substr($hasil['tanggal_scan'], 12); 
    		$data2[]=$data;
    	} 
		return $data2;
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

    public function get_max_by_nik($nik)
    {
        $hasil =$this->db->query("SELECT  io_mode FROM absensi  where id_absen=(SELECT MAX(id_absen) as id_absen FROM absensi  where nik='$nik')")->row_array(); 

        return $hasil;

    }

	public function export($awal, $akhir)
	{

		$data2 = array();
    	$io_name="";
    	$this->db->where('deleted',0);
    	$user = $this->db->get('user')->result_array();
    	foreach ($user as $key ) {
    		$nik = $key['nik']; 
    		$hasil =$this->db->query("SELECT MAX(tanggal_scan) as tanggal_scan, nik, io_mode, id_absen  FROM absensi  where tanggal_scan >= '$awal 00:00:00' and tanggal_scan <= '$akhir 00:00:00' AND nik='$nik'")->row_array(); 

    		$io_mode=$hasil['io_mode'];  
    		if ($io_mode=="0")
    		{
    			$io_name =$this->db->query("SELECT io_name from mode where io_mode=$io_mode")->row_array()['io_name'];
    		}
    		else if ($io_mode==null)
    		{
    			$io_name="-";
    		}
    		else
    		{
    			$io_name="-";
    		} 

    		$data['nama'] =$key['alias'];
    		$data['nik'] =$key['nik'];
    		$data['io_mode'] =$hasil['io_mode']; 
    		$data['io_name'] =$io_name; 
    		$data['id_absen'] =$hasil['id_absen']; 
    		$data['waktu'] = substr($hasil['tanggal_scan'], 12); 
    		$data2[]=$data;
    	} 
		return $data2;
		
		// $sql =$this->db->query("select * from absensi where tanggal_scan >= '$awal 00:00:00' and tanggal_scan <= '$akhir 00:00:00'")->result_array(); 

		// $sql = "select * from absensi where tanggal_scan >= '$awal 00:00:00' and tanggal_scan <= '$akhir 00:00:00'";
		// return $sql;
	}

	



}