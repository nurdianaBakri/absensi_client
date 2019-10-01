<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model 
{ 
	public function ceklogin($username, $password) 
	{
        $arrayName = array();
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $user = $this->db->get('user');
        if ($user->num_rows()>0)
        {
            $row = $user->row_array();
            $arrayName = array(
                'username' => $row['username'],
                'jenis_user' => $row['jenis_user'],
                'nama' => $row['nama'],
                'id' => $row['idu_user'],
                'logged_in'=>TRUE,
                'berhasil'=>"yes",
            );
        }
        else
        {
            $arrayName = array(
                'berhasil'=>"tidak",
                'logged_in'=>FALSE,
                'username'=>'',
            );
        }
        return $arrayName;
    }

}