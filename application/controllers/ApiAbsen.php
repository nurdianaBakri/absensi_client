<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiAbsen extends CI_Controller {

	var $API ="";
	public function __construct()
    {
        parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

		$this->API="http://nusapintar.com/kehadiran/index.php/absen/psti/";
		$this->API2="https://sia.unram.ac.id/_api/";
        $this->load->library('curl'); 
    }

    public function read_absen($nim)
    {
		$date_today = date('Y-m-d');
		$query_text2 = "UPDATE notif_absen SET `read`=1 where nim='$nim' and tanggal_scan='$date_today'";
		$query = $this->db->query($query_text2);

		if ($query)
		{
			$data_balikan = array(
				'query_update' =>  $query_text2,
				'berhasil' => true, 
			);
			echo json_encode($data_balikan);
		}
		else
		{
			$data_balikan = array(
				'query_update' =>  $query_text2,
				'berhasil' => false, 
			);
			echo json_encode($data_balikan);
		}
    	
    }

	public function getAbsen($nim)
	{
		$date_today = date('Y-m-d');
		$balikan = array();

		$data_absen="";

		if (strlen($nim)==9)
		{
			$data_absen = $this->db->query("SELECT * from notif_absen WHERE tanggal_scan='$date_today' and nim='$nim' ORDER by date_time ASC")->result();
		}
		else
		{
			$data_absen = $this->db->query("SELECT * from notif_absen WHERE tanggal_scan='$date_today' group by nik ASC")->result();
		}
		
		foreach ($data_absen as $data) 
		{
			$ket_io_mode="";
			$warna="";
			//dapatkan data dari database 
			$data->io_mode=$data->io_mode+0;

			if ($data->io_mode==4)
			{
				$ket_io_mode="Belum Absen";
				$warna="hitam";
			}
			else if ($data->io_mode==0)
			{
				$ket_io_mode="Ada, Bersedia";
				$warna="ijo";
			}
			else if ($data->io_mode==1) {
				$ket_io_mode="Pulang";
				$warna="biru";
			}
			else if ($data->io_mode==2) 
			{
				$ket_io_mode="Akan kembali";
				$warna="kuning";
			}
			else
			{
				$ket_io_mode="Ada-Sibuk";
				$warna="merah";
			}

			if ($data->scan_time_awal==NULL) 
			{
				$data->scan_time_awal="-";
			}

			if ($data->scan_time_akhir==NULL) 
			{
				$data->scan_time_akhir="-";
			}

			$balikan[] = array(
				'nama' => $data->nama, 
				'scan_time_awal' => $data->scan_time_awal, 
				'scan_time_akhir' => $data->scan_time_akhir, 
				'nik' => $data->nik, 
				'io_mode' => $data->io_mode, 
				'read' => $data->read, 
				'keterangan' => $data->keterangan, 
				'id_notif' => $data->id_notif, 
				'ket_io_mode' => $ket_io_mode,
				'warna' => $warna,
			);
			$warna="";

		}
		echo json_encode($balikan);
	}

	public function getAbsenToday($nim)
	{
		$query="";
		$data_balikan = array();
		$updateTerakhir = json_decode($this->curl->simple_get($this->API))->updateTerakhir;

		// $date = substr($updateTerakhir, 0,10);
		$date_today = date('Y-m-d');

		$this->db->where('tanggal_scan',$date_today);	
		$this->db->where('nim',$nim);
		$cek = $this->db->get('notif_absen');

		if ($cek->num_rows()>0) 
		{
			$query_text="";
			$query_text2="";
			//update data di database 
			$data = json_decode($this->curl->simple_get($this->API))->data;
			foreach ($data as $key)
			{
				//cek apakah data di database sama apa tidak 
				//cek scan time awal, akhir dan io mode 
				$nik = $key->nik;
				$scan_time_awal = $key->scan_time_awal;
				$scan_time_akhir = $key->scan_time_akhir;
				$io_mode = $key->io_mode;
				$count="";

				if ($scan_time_awal==NULL)
				{
					$scan_time_awal="kosong";
				}
				if ($scan_time_akhir==NULL)
				{
					$scan_time_akhir="kosong";
				}
				if ($io_mode===NULL)
				{
					$io_mode=4;
				}
				else
				{
					$io_mode=$io_mode;
				}

				$query_text = "SELECT * from notif_absen where nim='$nim' and nik='$nik' and scan_time_awal='$scan_time_awal' and scan_time_akhir='$scan_time_akhir' and io_mode=$io_mode";
				$count = $this->db->query($query_text);

				//update database 
				if ($count->num_rows()<1)
				{
					$query_text2 = "UPDATE notif_absen SET scan_time_awal='$scan_time_awal', scan_time_akhir='$scan_time_akhir', io_mode=$io_mode, `read`=0 where nim='$nim' and nik='$nik' and tanggal_scan='$date_today'";

					$query = $this->db->query($query_text2);

					if ($query)
					{
						$data_balikan[] = array(
							'query_cek' =>  $query_text,
							'query_update' =>  $query_text2,
							'berhasil' => true, 
						);
					}
					else
					{
						$data_balikan[] = array(
							'query_cek' =>  $query_text,
							'query_update' =>  $query_text2,
							'berhasil' => false, 
						);
					}
				}
				else
				{
					$data_balikan[] = array(
						'query_cek' =>  $query_text,
						'berhasil' => true, 
						'num_rows' => $count->num_rows(), 
					);
				}
			}
		}
		else
		{
			$data_balikan = $this->insertNotifAbsen($nim,$date_today);
		}
		echo json_encode($data_balikan);
	}

	public function getNotif($iduser)
	{
		$date_today=date('Y-m-d');
		$hitung=0;
		$hitung = $this->db->query("SELECT count(id_notif) id_notif FROM notif_absen WHERE nim='$iduser' and tanggal_scan='$date_today' and `read`=0")->row();
		$data_balikan = array(
			'unread' => $hitung->id_notif, 
		);
		echo json_encode($data_balikan);
	}

	public function insertNotifAbsen($nim, $date)
	{
		$data_balikan = array();
		$query="";

		//masukkan data ke database 
		$data = json_decode($this->curl->simple_get($this->API))->data;
		foreach ($data as $key)
		{
			$ket_io_mode="";
			if ($key->io_mode===NULL)
			{
				$key->io_mode=4;
				$ket_io_mode="Belum absen";
			}
			else if ($key->io_mode==0)
			{
				$ket_io_mode="Ada, Bersedia";
			}
			else if ($key->io_mode==1) {
				$ket_io_mode="Pulang";
			}
			else if ($key->io_mode==2) 
			{
				$ket_io_mode="Akan kembali";
			}
			else
			{
				$ket_io_mode="Ada-Sibuk";
			}

			if ($key->scan_time_awal==NULL)
			{
				$key->scan_time_awal="kosong";
			}
			if ($key->scan_time_akhir==NULL)
			{
				$key->scan_time_akhir="kosong";
			}

			$nik ='';
			if ($key->nik==NULL || $key->nik=='-')
			{
        		$nik = $key->first_name;
			}
			else
			{
				$nik = $key->nik;
			}

				$data_inputan=array(
					'nama' => $key->first_name." ".$key->last_name, 
					'scan_time_awal' => $key->scan_time_awal, 
					'scan_time_akhir' => $key->scan_time_akhir, 
					'nik' => $nik, 
					'io_mode' => $key->io_mode, 
					'nim' => $nim,
					'tanggal_scan' => $date,
					'read' => 0,
					'keterangan' => $ket_io_mode,
				);
				$query = $this->db->insert('notif_absen',$data_inputan);
			

			if ($query)
			{
				$data_balikan[]=array(
					'nik' => $key->nik, 
					'berhasil' => true, 
				);
			}
			else
			{
				$data_balikan[]=array( 
					'berhasil' => false, 
				);
			}
		}

		return $data_balikan;
	}

	public function edit_absen($nik)
	{
		$date = date('Y-m-d');
		$balikan = $this->db->query("SELECT * from notif_absen where nik ='$nik' and tanggal_scan like '%$date%'")->row_array();
		echo json_encode($balikan);
	}

	public function update_keterangan_absen()
	{
    	$data3 = json_decode(file_get_contents("php://input"));
        $id_notif = $data3->id_notif+0;
        $keterangan = $data3->keterangan;
        $status_pesan="";

        $query_text2 = "UPDATE notif_absen SET keterangan='$keterangan' where id_notif=$id_notif";
		$query = $this->db->query($query_text2);
		if ($query!=true)
		{
			$status_pesan = "proses merubah keterangan gagal";

		}
		else
		{
			$status_pesan = "proses merubah keterangan berhasil";

		}
		$data = array(
			'keterangan' => $keterangan, 
			'id_notif' => $id_notif, 
			'status_pesan' => $status_pesan, 
			'status1' =>$query, 
			'query' => "UPDATE notif_absen SET keterangan='$keterangan' where id_notif=$id_notif", 
		);
        echo json_encode($data);
	}

	public function getAbsenByNik($nik)
	{
		$date_today=date('Y-m-d');
		$query_text2 = "SELECT * from notif_absen where nik='$nik' and tanggal_scan='$date_today'";
		$query = $this->db->query($query_text2)->row_array();
		echo json_encode($query);
	}
		

}