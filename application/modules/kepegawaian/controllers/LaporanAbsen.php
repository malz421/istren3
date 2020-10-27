<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class LaporanAbsen extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
	$this->load->model('all/M_departemen');
	$this->load->model('M_karyawan');
	$this->load->model('all/M_unitkerja');
	$this->load->model('all/M_departemen');
	$this->load->model('M_laporanabsen');
	$this->load->model('all/M_combo');
  }

  public function index()
  {

	if($this->session->userdata('status') != TRUE){
		redirect(base_url("all/login"));
  	}

		$akseslembaga = $this->session->userdata('akseslembaga');
		$idlembaga = $this->session->userdata('idlembaga');
		$aksesdepartemen = $this->session->userdata('aksesdepartemen');
		$idepartemen = $this->session->userdata('iddepartemen');

		$tglawal = date('d-m-Y');
		$tglakhir = date('d-m-Y');
		$idkaryawan = $this->input->post('idkaryawan');

		//Jika akses antar lemmbaga 
		if ($akseslembaga == 'Y'){
		$idlembaga = 'all';
		}

		if ($aksesdepartemen == 'Y'){
		$idepartmen = 'all';
		}

	
		$data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
		$data['datadepartemen'] = $this->M_departemen->tampil_departemen($idlembaga);
		$data['combounitkerja'] = $this->M_combo->combounitkerja();

		$data['rekapabsen'] = $this->M_laporanabsen->rekap_absen_karyawan($idkaryawan,$tglawal,$tglakhir);


		$data['header'] = 'layout/header';
		$data['topbar'] = 'layout/topbar';
		$data['sidebar'] = 'layout/sidebar';
		$data['content'] = 'laporanabsen/v_rekapabsenkaryawan';
		$data['js'] = 'layout/js';
		$data['jscontent'] = 'laporanabsen/jscontent';
		$data['footer'] = 'layout/footer';
		$this->load->view('layout/main', $data);
	}

	public function rekap_absensi_karyawan()
	{
			if($this->session->userdata('status') != TRUE){
					redirect(base_url("all/login"));
			}
			
			$akseslembaga = $this->session->userdata('akseslembaga');
			$idlembaga = $this->session->userdata('idlembaga');
			$aksesdepartemen = $this->session->userdata('aksesdepartemen');
			$idepartemen = $this->session->userdata('iddepartemen');

			$tglawal = $this->input->post('tglawal');
			$tglakhir = $this->input->post('tglakhir');
			$idkaryawan = $this->input->post('idkaryawan');
			
			
			//Jika akses antar lemmbaga 
			if ($akseslembaga == 'Y'){
				$idlembaga = 'all';
			}

			if ($aksesdepartemen == 'Y'){
				$idepartmen = 'all';
			}
			
		   $tglawal = $this->M_karyawan->rubah_tglformat($tglawal);
		   $tglakhir = $this->M_karyawan->rubah_tglformat($tglakhir);

			
			$data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
			$data['datadepartemen'] = $this->M_departemen->tampil_departemen($idlembaga);
			$data['combounitkerja'] = $this->M_combo->combounitkerja();
			$data['rekapabsen'] = $this->M_laporanabsen->rekap_absen_karyawan($idkaryawan,$tglawal,$tglakhir);
			
			$data['header'] = 'layout/header';
			$data['topbar'] = 'layout/topbar';
			$data['sidebar'] = 'layout/sidebar';
			$data['content'] = 'laporanabsen/v_rekapabsenkaryawan';
			$data['js'] = 'layout/js';
			$data['jscontent'] = 'laporanabsen/jscontent';
			$data['footer'] = 'layout/footer';
			$this->load->view('layout/main', $data);
	}

	public function exp_rekap_absensi_karyawan($idkaryawan,$tglawal,$tglakhir)
	{
		if($this->session->userdata('status') != "login"){
			redirect(base_url("all/login"));
		}

		$tglawal = $this->M_karyawan->rubah_tglformat($tglawal);
		$tglakhir = $this->M_karyawan->rubah_tglformat($tglakhir);
		
		$data['rekapabsen'] = $this->M_laporanabsen->exp_absen_karyawan($idkaryawan,$tglawal,$tglakhir);

		$data['judul'] = 'Laporan Presensi Karyawan';
		
		$this->load->view('kepegawaian/laporanabsen/v_exp_rekap_absen_karyawan',$data);
	}


	public function exp_rekap_absensi_unitkerja($idunitkerja,$tglawal,$tglakhir)
	{
		if($this->session->userdata('status') != "login"){
			redirect(base_url("all/login"));
		}
		
		$tglawal = $this->M_karyawan->rubah_tglformat($tglawal);
		$tglakhir = $this->M_karyawan->rubah_tglformat($tglakhir);

	
		$data['rekapabsen'] = $this->M_laporanabsen->rekap_absen_unitkerja($idunitkerja,$tglawal,$tglakhir);

		
		$data['judul'] = 'Laporan Presensi Karyawan';
		
		$this->load->view('kepegawaian/laporanabsen/v_exp_rekap_absen_unitkerja',$data);
	}

	public function RekapAbsenPerDep(){
		if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

        $akseslembaga = $this->session->userdata('akseslembaga');
        $idlembaga = $this->session->userdata('idlembaga');
        $aksesdepartemen = $this->session->userdata('aksesdepartemen');
        $idepartemen = $this->session->userdata('iddepartemen');
        

        //Jika akses antar lemmbaga
        if ($akseslembaga == 'Y') {
            $idlembaga = 'all';
        }

        if ($aksesdepartemen == 'Y') {
            $idepartemen = 'all';
        }

        $data['combolembaga'] = $this->M_combo->combolembaga($idlembaga);
        $data['combounitkerja'] = $this->M_combo->combounitkerja($idepartemen);
        $data['comboshift'] = $this->M_combo->comboshift();

        $data['header'] = 'layout/header';
        $data['topbar'] = 'layout/topbar';
        $data['sidebar'] = 'layout/sidebar';
        $data['content'] = 'laporanabsen/v_rekapabsendep';
        $data['js'] = 'layout/js';
        $data['jscontent'] = 'laporanabsen/jscontent';
        $data['footer'] = 'layout/footer';
        $this->load->view('layout/main', $data);
	}

	//Rekap Absensi Per Departemen
    public function TampilRekapAbsensiByDep(){

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

		$idlembaga = $this->input->post('idlembaga');
		$idunitkerja = $this->input->post('idunitkerja');
        $tglawal = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode1'));
		$tglakhir = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode2'));
		
		$data['datakaryawan'] = $this->M_karyawan->DataKaryawanByDep($idlembaga,$idunitkerja);
		$data['idlembaga'] = $idlembaga;
        $data['idunitkerja'] = $idunitkerja;
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;

        $this->load->view('laporanabsen/v_rekapabsendepajax', $data);
	}
	
	public function ExportRekapAbsenDep(){

       if ($this->session->userdata('status') != true) {
        redirect(base_url("all/login"));
        }
            $idlembaga = $this->input->post('idlembaga');
			$idunitkerja = $this->input->post('idunitkerja');
			$tglawal = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode1'));
			$tglakhir = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode2'));


			$data['datakaryawan'] = $this->M_karyawan->DataKaryawanByDep($idlembaga, $idunitkerja);
			$data['idlembaga'] = $idlembaga;
			$dataunitkerja = $this->M_unitkerja->detil_unitkerja($idunitkerja)->row_array();
			if($dataunitkerja){
				$data['namaunitkerja'] = $dataunitkerja['nama_unit_kerja'];
			}
			else{
				$data['namaunitkerja'] = '-';
			}
			

       
			$data['idunitkerja'] = $idunitkerja;
			$data['tglawal'] = $tglawal;
			$data['tglakhir'] = $tglakhir;

            $this->load->view('laporanabsen/v_rekapabsendepexp', $data);
	}
	
	//Rekap Absensi Per Departemen END


	//Rekap Absensi Per Karyawan START
	
//Rekap Absensi Per Departemen
    public function TampilRekapAbsensiByKaryawan(){

        if ($this->session->userdata('status') != true) {
            redirect(base_url("all/login"));
        }

		$idlembaga = $this->input->post('idlembaga');
		$idunitkerja = $this->input->post('idunitkerja');
		$idkaryawan = $this->input->post('idkaryawan');
        $tglawal = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode1'));
		$tglakhir = $this->M_karyawan->rubah_tglformat($this->input->post('tglperiode2'));
		
	
		$data['rekapabsen'] = $this->M_laporanabsen->rekap_absen_karyawan($idkaryawan, $tglawal, $tglakhir);

		$data['idlembaga'] = $idlembaga;
		$data['idunitkerja'] = $idunitkerja;
		$data['idkaryawan'] = $idkaryawan;
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;

        $this->load->view('laporanabsen/v_rekapabsenkaryawanajax', $data);
	}
	
	public function ExportRekapAbsenKaryawan(){

       if ($this->session->userdata('status') != true) {
        redirect(base_url("all/login"));
        }
            $idlembaga = $this->input->post('idlembaga');
			$idunitkerja = $this->input->post('idunitkerja');
			$idkaryawan = $this->input->post('idkaryawan');
			$tglawal = $this->input->post('tglperiode1');
			$tglakhir = $this->input->post('tglperiode2');



			$data['rekapabsen'] = $this->M_laporanabsen->exp_absen_karyawan($idkaryawan, $tglawal, $tglakhir);
			$data['idkaryawan'] = $idkaryawan;
			$data['idlembaga'] = $idlembaga;
			$data['idunitkerja'] = $idunitkerja;
			$data['tglawal'] = $tglawal;
			$data['tglakhir'] = $tglakhir;
			$data['judul'] = 'Laporan Presensi Karyawan';

			$this->load->view('kepegawaian/laporanabsen/v_exp_rekap_absen_karyawan', $data);
						
			

            //$this->load->view('laporanabsen/v_rekapabsendepexp', $data);
	}


	//Rekap Absensi Per Karyawan END



	/*public function exp_rekap_absen_karyawan1(){
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
			$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
			$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
			// Buat header tabel nya pada baris ke 3
			$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
			$excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
			$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
			$excel->setActiveSheetIndex(0)->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
			$excel->setActiveSheetIndex(0)->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
			// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
			//$siswa = $this->SiswaModel->view();
			$no = 1; // Untuk penomoran tabel, di awal set dengan 1
			$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
			
			// Set width kolom
			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
			
			// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
			$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
			// Set orientasi kertas jadi LANDSCAPE
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			// Set judul file excel nya
			$excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
			$excel->setActiveSheetIndex(0);
			// Proses file excel
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="Data Siswa.xlsx"'); // Set nama file excel nya
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
		
		
		
	}

	public function exp_rekap_absen_karyawan()
	{
	
		
				// Setup Excel Header masing-masing Sheets
				$header_mhs = ['Nama Mahasiswa', 'Alamat', 'Nilai'];
				$header_dsn = ['Nama Dosen', 'Alamat', 'Gaji'];
				$header_kry = ['Nama Karyawan', 'Alamat', 'Gaji'];
		
				// simulate data dari database, kalau data kamu dari DB, silahkan
				// bentuk menjadi seperti ini
		
				$data_mhs = [
					['Agus', 'Jl. Jaksa Jakarta', 90],
					['Budy', 'Jl. Palmerah Jakarta', 70],
					['Cecep', 'Jl. Sukacita Bandung', 77],
				];
		
				$data_dsn = [
					['Dr. Sutomo Ph.D', 'Jl. Patimura Jakarta', 7500000],
					['Ir. Dedot Pekok', 'Jl. Cilincing Jakarta', 5600000],
					['Sontoloyo S.kom M.kom', 'Jl. senayan Bandung', 4700000],
				];
		
				$data_kry = [
					['Nur soleh', 'Jl. bebas polusi Jakarta', 3200000],
					['Denis', 'Jl. kovyor Belitung', 2600000],
					['Sutarni', 'Jl. sudirman Jakarta', 2700000],
				];
		
				// setup Spout Excel Writer, set tipenya xlsx
				$writer = WriterFactory::create(Type::XLSX);
				// download to browser
				$writer->openToBrowser('Contoh-Data-Saja.xlsx');
				// set style untuk header
				$headerStyle = (new StyleBuilder())
					   ->setFontBold()
					   ->build();
		
		
				// write ke Sheet pertama
				$writer->getCurrentSheet()->setName('MAHASISWA');
				// header Sheet pertama
				$writer->addRowWithStyle($header_mhs, $headerStyle);
				// data Sheet pertama
				$writer->addRows($data_mhs);
		
				// write ke Sheet kedua
				$writer->addNewSheetAndMakeItCurrent()->setName('DOSEN');
				// header Sheet kedua
				$writer->addRowWithStyle($header_dsn, $headerStyle);
				// data Sheet kedua
				$writer->addRows($data_dsn);
		
				// write ke Sheet ketiga
				$writer->addNewSheetAndMakeItCurrent()->setName('KAYRAWAN');
				// header Sheet ketiga
				$writer->addRowWithStyle($header_kry, $headerStyle);
				// data Sheet ketiga
				$writer->addRows($data_kry);
		
		
				// close writter
				$writer->close();
		
		
				
	}*/
 
 
   
}
  
	

