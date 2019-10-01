<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_user extends CI_Model
{
    function refresh_data_mhs($nim, $data_input)
    {
        $berhasil=false;

        //cek nim yang sama 
        $this->db->where('username',$nim);
        $cek = $this->db->get('user');
        if ($cek->num_rows()<1) 
        {
            $berhasil = $this->db->insert("user",$data_input);
        }
        return $berhasil;
    }

    function refresh_data_dsn($username, $data_input)
    {
        $berhasil=false;

        //cek nim yang sama 
        $this->db->where('username',$username);
        $cek = $this->db->get('user');
        if ($cek->num_rows()<1) 
        {
            $berhasil = $this->db->insert("user",$data_input);
        }
        return $berhasil;
    }

    public function getAll()
    {
    	$data2 = array();
        $data = array(
            !'level' => 'mahasiswa',
        );

        $query = $this->db->get_where("user",$data);
        $query = $query->result_array();

        foreach ($query as $row) 
        {
            $where = array('id' =>$row['id'] );
            $data2[] = array(
                'username' => $row['username'],
                'level' => $row['level'],
                'nama' => $row['nama'],
                'id' => $row['id'],
            );
        }
        return $data2;
    }


    public function reset($username)
    {
         //generate pass
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $password = substr( str_shuffle( $chars ), 0, 8 );
        $passwordMD5 = md5($password);

        $sql = $this->db->query("UPDATE user SET password='$passwordMD5' WHERE username='$username'");
        if ($sql === TRUE) 
        {
            $dadta = array(
                'password' =>  $password, 
                'sukses' =>  1, 
            );
            return ($dadta);
        }
        else
        {
            $dadta = array(
                'password' =>  'NULL', 
                'sukses' =>  0, 
            );
            return ($dadta);
        }
    }
}