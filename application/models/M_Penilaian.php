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

	public function insert($data)
	{
		return $this->db->insert('nilai',$data);
	}

	public function getTahunDanBulan()
	{
		return $this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m') as tanggal_scan FROM absensi");
	}

	public function getPenilaian($nik, $masa)
	{
		if ($nik=="semua")
		{
			$data2 = array();
	        $io_name="";
	    	$icon="";
	    	$this->db->where('deleted',0);
	    	$user = $this->db->get('user')->result_array();
	    	foreach ($user as $key ) {
	    		$hadir=0;
	    		$nik = $key['nik'];  

	    		$tahun = substr($masa, 0,4);
	    		$bulan = substr($masa, 5); 

	            $hadir =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode!=6 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')"); 

	            $sakit =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=7 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')"); 

	            $izin =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=8 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')"); 

	            $tanpa_ket =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=9 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')");

	            $cuti =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=10 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')");  

	            $tugas_dinas =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=11 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')");  

	            $hadir2 =$hadir->num_rows();

	    		$data['nama'] =$key['alias'];
	    		$data['nik'] =$key['nik'];
	    		$data['nama'] =$key['first_name']." ".$key['last_name'];
	    		$data['tahun'] =$tahun;
	    		$data['bulan'] =$bulan;
	    		$data['hadir'] =$hadir2;    
	    		$data['sakit'] =$sakit->num_rows();    
	    		$data['izin'] =$izin->num_rows();    
	    		$data['tanpa_ket'] =$tanpa_ket->num_rows();    
	    		$data['cuti'] =$cuti->num_rows();    
	    		$data['tugas_dinas'] =$tugas_dinas->num_rows();  

	    		$ignore = array(1,6); 
	    		//get jumlah hari kerja 
	    		$jml_hari_kerja = $this->countDays($tahun,$bulan,$ignore); 
	    		$data['jml_hari_kerja'] =$jml_hari_kerja;

	    		if ($data['hadir']==0)
	    		{
	    			$data['persen']=0;
	    		}
	    		else
	    		{
	    			$data['persen'] = round((($data['hadir']/$jml_hari_kerja)*100),1);
	    		} 

	    		$data['nilai'] = $this->hitungNilai($data['hadir'],$data['tugas_dinas'],$jml_hari_kerja);

	    		$data2[]=$data;
	    	} 
			return $data2;
		}
		else
		{
			$data2 = array();

			$tahun = substr($masa, 0,4);
    		$bulan = substr($masa, 5); 

    		$this->db->where('nik',$nik);
    		$user = $this->db->get('user')->row_array();

            $hadir =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode!=6 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')"); 

            $sakit =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=7 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')"); 

            $izin =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=8 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')"); 

            $tanpa_ket =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=9 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')");

            $cuti =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=10 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')");  

            $tugas_dinas =$this->db->query("SELECT distinct date_format(tanggal_scan, '%Y-%m-%d') as tanggal_scan FROM absensi WHERE io_mode=11 and nik='$nik' and (tanggal_scan BETWEEN '$masa-01 00:00:01' and '$masa-31 23:59:59')");  

    		$data['nama'] =$user['alias'];
    		$data['nik'] =$user['nik'];
    		$data['nama'] =$user['first_name']." ".$user['last_name'];
    		$data['tahun'] =$tahun;
    		$data['bulan'] =$bulan;
    		$data['hadir'] =$hadir->num_rows();    
    		$data['sakit'] =$sakit->num_rows();    
    		$data['izin'] =$izin->num_rows();    
    		$data['tanpa_ket'] =$tanpa_ket->num_rows();    
    		$data['cuti'] =$cuti->num_rows();    
    		$data['tugas_dinas'] =$tugas_dinas->num_rows();    
    		 

    		$ignore = array(1,6); 
    		//get jumlah hari kerja 
    		$jml_hari_kerja = $this->countDays($tahun,$bulan,$ignore); 
    		$data['jml_hari_kerja'] =$jml_hari_kerja;

    		if ($hadir->num_rows()==0)
    		{
    			$data['persen']=0;
    		}
    		else
    		{
    			$data['persen'] = round((($data['hadir']/$jml_hari_kerja)*100),1);
    		} 

    		$data['nilai'] = $this->hitungNilai($data['hadir'],$data['tugas_dinas'],$jml_hari_kerja);

    		$data2[]=$data;
    		return $data2;
		}
		// return $this->db->query("SELECT * from absensi where nik =$nik and tanggal_scan like '$masa%'");
		
	}

	

	public function countDays($year, $month, $ignore) {
	    $count = 0;
	    $counter = mktime(0, 0, 0, $month, 1, $year);
	    while (date("n", $counter) == $month) {
	        if (in_array(date("w", $counter), $ignore) == false) {
	            $count++;
	        }
	        $counter = strtotime("+1 day", $counter);
	    }
	    return $count;
	}
	// echo countDays(2013, 1, array(0, 6)); // 23

	public function hitungNilai($hadir,$tugas_dinas,$jml_hari_kerja)
	{
		$nilaiAngka = (($hadir + $tugas_dinas) / $jml_hari_kerja) *100;

	      // var_dump($nilaiAngka);

	      if ($nilaiAngka>=80)
	      {
	        return "A";
	      }
	      else if (($nilaiAngka>=68) && ($nilaiAngka<=79.9))
	      {
	        return "B";
	      }
	      else if (($nilaiAngka>=56) && ($nilaiAngka<=67.9))
	      {
	        return "C";
	      }
	      else if (($nilaiAngka>=45) && ($nilaiAngka<=55.9))
	      {
	        return "D";
	      }
	      else if (($nilaiAngka>=0) && ($nilaiAngka<=44.9))
	      {
	        return "E";
	      }
	      else
	      {
	        return "Undefinde";
	      }
	}
 
}
?>