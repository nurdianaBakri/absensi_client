
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_absensi extends CI_Model {

    // SELECT MAX(id_absen) as id_absen, nik, io_mode, id_absen  FROM absensi  where tanggal_scan like '$today%' AND nik='$nik'

    public function getall($today)
    {
    	$data2 = array();
        $io_name="";
    	$icon="";
    	$this->db->where('deleted',0);
    	$user = $this->db->get('user')->result_array();
    	foreach ($user as $key ) {
    		$nik = $key['nik'];  

            $hasil =$this->db->query("SELECT nik, io_mode, tanggal_scan, id_absen FROM absensi  where id_absen=(SELECT MAX(id_absen) as id_absen FROM absensi  where nik='$nik') and tanggal_scan like '%$today%'")->row_array(); 

    		$io_mode=$hasil['io_mode'];  
            if ($io_mode!=null)
            {
                $io_mode2 =$this->db->query("SELECT io_name,icon from mode where io_mode=$io_mode")->row_array();

                $io_name = $io_mode2['io_name'];
                $icon = $io_mode2['icon'];
            }
            else if ($io_mode==null)
            {
                $io_name="";
                $icon="<i class='fa fa-ban' style='font-size:20px;color:red'></i> Belum absen";
            }
            else
            {
                $io_name="";
                $icon="<i class='fa fa-ban' style='font-size:20px;color:red'></i>";
            } 

    		$data['nama'] =$key['alias'];
    		$data['nik'] =$key['nik'];
    		$data['io_mode'] =$hasil['io_mode']; 
            $data['io_icon'] =$icon; 
            $data['io_name'] =$io_name; 
    		$data['foto'] =$key['foto']; 
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
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename.".xlsx";
	
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
		$data_pertanggal = array();
    	$io_name="";
        $q1 ="SELECT DISTINCT(DATE(tanggal_scan)) as tanggal_scan FROM absensi WHERE DATE(tanggal_scan) >= '$awal' AND DATE(tanggal_scan) <= '$akhir' ORDER BY tanggal_scan DESC";

        $hasil_tanggal =$this->db->query($q1)->result_array(); 

        foreach ($hasil_tanggal as $hasil_tanggal)
        {
            $data2 = array();

            $icon='';
            $tanggal_scan = $hasil_tanggal['tanggal_scan'];
            $q2 ="SELECT tanggal_scan, nik, io_mode, id_absen  FROM absensi  where tanggal_scan like '$tanggal_scan%' ORDER by nik DESC";

            $hasil =$this->db->query($q2)->result_array(); 

            foreach ($hasil as $hasil)
            {
                $io_mode=$hasil['io_mode'];  
                if ($io_mode!=null)
                {
                    $io_mode2 =$this->db->query("SELECT io_name,icon from mode where io_mode=$io_mode")->row_array();

                    $io_name = $io_mode2['io_name'];
                    $icon = $io_mode2['icon'];
                }
                else if ($io_mode==null)
                {
                    $io_name="";
                    $icon="<i class='fa fa-ban' style='font-size:20px;color:red'></i>";
                }
                else
                {
                    $io_name="";
                    $icon="<i class='fa fa-ban' style='font-size:20px;color:red'></i>";
                } 

                $data['nama'] =$hasil['nik'];
                $data['nik'] =$hasil['nik'];
                $data['io_mode'] =$hasil['io_mode']; 
                $data['io_name'] =$io_name; 
                $data['io_icon'] =$icon; 
                $data['id_absen'] =$hasil['id_absen']; 
                $data['waktu'] = substr($hasil['tanggal_scan'], 11); 
                $data['date_scan'] = $hasil['tanggal_scan']; 
                $data['q2'] = $q2; 
                $data2[]=$data; 
            }

            $data_pertanggal[] = array(
                'tanggal' => $tanggal_scan, 
                'q1' => $q1, 
                'hasil_tanggal' => $hasil_tanggal, 
                'data_scan' => $data2, 
            );
        }

        return $data_pertanggal;
	}

	



}