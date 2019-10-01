<?php

class M_Penilaian extends CI_Model
{ 
	function getAll()
	{ 
	  $this->db->where('jenis_user',3);
	  $query = $this->db->get('user');
	  return $query;	  
	}   

	function update($where,$data)
	{
		$this->db->where($where);
		return $this->db->update('nilai', $data);
	}
 
}
?>