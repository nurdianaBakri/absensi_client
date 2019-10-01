
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function getall($today)
    {
        $this->db->where('tanggal_scan',$today);
    	$data =$this->db->get('absensi');
		return $data;
    }



}