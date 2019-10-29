<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenilaianDosen extends CI_Controller {

    var $API ="";
	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in') != TRUE){
            redirect("Login/index");
        }
    }

    function index()
    {
        $getallData['title'] = "Penilaian Dosen";
        $getallData['data'] = "";
        $data= $this->M_user->getAll();
        if ($data->num_rows()>0) 
        {
            $getallData['data']=$data->result_array();
        }
        else
        {
            $getallData['data'] = array();
        }

        //get bulan dan tahun absensi
        $ThnBulan = $this->M_Penilaian->getTahunDanBulan();
        if ($ThnBulan->num_rows()>0) 
        {
            $getallData['tahunBulan']=$ThnBulan->result_array();
        }
        else
        {
            $getallData['tahunBulan'] = array();
        }

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("penilaian/form_nilai2" ,$getallData); 
        $this->load->view("include/footer");
    }

     public function getPenilaian()
    {
        $masa = $this->input->post('masa');  
        $data['title'] = "REKAP KEHADIRAN DOSEN";
        $data['title_rekap'] = "REKAP KEHADIRAN DOSEN TEKNIK INFORMATIKA UNRAM BULAN ".substr($masa, 5)." 2019";
        $nik = $this->input->post('nik');
        
        //get data penilaian berdasarkan nik dan masa 
        // $data['data'] = $this->M_Penilaian->getPenilaian($nik,$masa);

        // $this->load->view("include/header",$data);
        // $this->load->view("include/topmenu");
        // $this->load->view("include/leftmenu" );
        // $this->load->view("penilaian/penilaian2" ,$data); 
        // $this->load->view("include/footer"); 

        $this->export($nik, $masa);
    }

    public function export($nik,$masa){
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Data Siswa")
                 ->setSubject("Siswa")
                 ->setDescription("Laporan Semua Data Siswa")
                 ->setKeywords("Data Siswa");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "REKAP KEHADIRAN DOSEN TEKNIK INFORMATIKA UNRAM"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:L1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "NIK"); // Set kolom B3 dengan tulisan "NIK"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Gol"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Jumlah Hari Kerja"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "H"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "S"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('H3', "I"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('I3', "C"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('J3', "TK"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('K3', "T"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('L3', "%"); // Set kolom E3 dengan tulisan "ALAMAT"
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    $raport = $this->M_Penilaian->getPenilaian($nik,$masa);
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4

    // var_dump($raport);
    foreach($raport as $data){ // Lakukan looping pada variabel siswa
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nik']);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nama']);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "-");
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['jml_hari_kerja']);
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['hadir']);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['sakit']);
      $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['izin']);
      $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['cuti']);
      $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['tanpa_ket']);
      $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['tugas_dinas']);
      $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data['persen']);
      
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
      
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(8); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(40); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(12); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(12); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(12); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(12); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(12); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('J')->setWidth(12); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('K')->setWidth(12); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('L')->setWidth(12); // Set width kolom E
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
    $excel->setActiveSheetIndex(0);

    // Rename sheet 
    // $excel->getActiveSheet()->setTitle('Simple');


    // // Save Excel 2007 file
    // echo date('H:i:s') . " Write to Excel2007 format\n";
    // $objWriter = new PHPExcel_Writer_Excel2007($excel);
    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header('Content-Disposition: attachment;filename="KREDIKARTI.xlsx"');

    // ob_end_clean();
    // $objWriter->save('php://output');

    // ============================================
 
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="REKAP KEHADIRAN DOSEN TEKNIK INFORMATIKA UNRAM.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    ob_end_clean();

    $write->save('php://output');

    // var_dump($excel);
  }

 
    function nilai($nik)
    {
        $getallData['title'] = "Form Penilaian Dosen ".$nik;
        $where = array('nik' => $nik, );

        $data= $this->M_user->detail($where);
        if ($data->num_rows()>0) 
        {
            $getallData['data']=$data->row_array();
        }
        else
        {
            $getallData['data'] = array();
        }

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("penilaian/form_nilai" ,$getallData);
        $this->load->view("include/footer");
    }

    function detail($nik)
    {
        $getallData['title'] = "Form Penilaian Dosen ".$nik;
        $where = array('nik' => $nik, );

        $data= $this->M_user->detail($where);
        if ($data->num_rows()>0) 
        {
            $getallData['data']=$data->row_array();
        }
        else
        {
            $getallData['data'] = array();
        }

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("penilaian/form_nilai" ,$getallData);
        $this->load->view("include/footer");
    }

    public function do_nilai()
    {
        $nik =$this->input->post('nik');
        $keterangan =$this->input->post('keterangan');

        $data = array(
            'nik' => $nik, 
            'keterangan' => $keterangan, 
        );

        $cek  = $this->M_Penilaian->insert($data);
        if ($cek==true)
        {
            $this->session->set_flashdata('pesan',"Proses input nilai berhasil ");
        }
        else
        {
            $this->session->set_flashdata('pesan',"Proses input nilai gagal ");
        }
        redirect('PenilaianDosen/nilai/'.$nik);
    }

   
   
}