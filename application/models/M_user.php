<?php

class M_user extends CI_Model
{ 
	function getAll()
	{ 
	  $query = $this->db->get('user');
	  return $query;	  
	}   

	function update($where,$data)
	{
		$this->db->where($where);
		return $this->db->update('user', $data);
	}
 
}
?>