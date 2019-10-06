<?php

class M_mode extends CI_Model
{ 
	function getAll()
	{ 
	  $query = $this->db->get('mode');
	  return $query;	  
	}   
 
}
?>