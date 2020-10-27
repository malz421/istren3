<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_laporangaji extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	  // $this->load->model('M_karyawan');
	 }
	
	
	function Cari_Rekap_Gaji($idlembaga,$idunitkerja,$idperiode){
		$query=$this->db->query("SELECT `karyawan`.`nip_karyawan`,`karyawan`.`nama_karyawan`,unit_kerja.nama_unit_kerja,payroll_teamplate.`nama_teamplate`,`payroll_periode_gaji`.`nama_periode`,`payroll_transaksi`.`status`, SUM(CASE WHEN `payroll_detail_transaksi`.`type` ='Pengurangan' THEN `payroll_detail_transaksi`.`jml_gaji` END) AS Potongan, SUM(CASE WHEN `payroll_detail_transaksi`.`type` ='Penambahan' THEN `payroll_detail_transaksi`.`jml_gaji` END) AS Pendapatan
	     FROM `payroll_transaksi` JOIN `payroll_detail_transaksi` ON `payroll_detail_transaksi`.`id_transaksi` = `payroll_transaksi`.`id_transaksi` JOIN `payroll_periode_gaji` ON `payroll_periode_gaji`.`id_periode` = `payroll_transaksi`.`id_periode` JOIN `payroll_teamplate` ON `payroll_teamplate`.`id_teamplate` = `payroll_transaksi`.`id_teamplate` JOIN `karyawan` ON `karyawan`.`id_karyawan` = `payroll_transaksi`.`id_karyawan` JOIN `unit_kerja` ON `unit_kerja`.`id_unit_kerja` = `karyawan`.`id_unit_kerja` WHERE `karyawan`.`id_unit_kerja` = $idunitkerja AND `payroll_transaksi`.`id_periode` = $idperiode AND `karyawan`.`id_lembaga` = $idlembaga GROUP BY `payroll_detail_transaksi`.`id_transaksi`")->result();
		return $query;
	}
	function Cari_Rekap_Gaji_Umum($idlembaga){
		$query=$this->db->query("SELECT `karyawan`.`nip_karyawan`,`karyawan`.`nama_karyawan`,unit_kerja.nama_unit_kerja,payroll_teamplate.`nama_teamplate`,`payroll_periode_gaji`.`nama_periode`,`payroll_transaksi`.`status`, SUM(CASE WHEN `payroll_detail_transaksi`.`type` ='Pengurangan' THEN `payroll_detail_transaksi`.`jml_gaji` END) AS Potongan, SUM(CASE WHEN `payroll_detail_transaksi`.`type` ='Penambahan' THEN `payroll_detail_transaksi`.`jml_gaji` END) AS Pendapatan
	     FROM `payroll_transaksi` JOIN `payroll_detail_transaksi` ON `payroll_detail_transaksi`.`id_transaksi` = `payroll_transaksi`.`id_transaksi` JOIN `payroll_periode_gaji` ON `payroll_periode_gaji`.`id_periode` = `payroll_transaksi`.`id_periode` JOIN `payroll_teamplate` ON `payroll_teamplate`.`id_teamplate` = `payroll_transaksi`.`id_teamplate` JOIN `karyawan` ON `karyawan`.`id_karyawan` = `payroll_transaksi`.`id_karyawan` JOIN `unit_kerja` ON `unit_kerja`.`id_unit_kerja` = `karyawan`.`id_unit_kerja` WHERE `karyawan`.`id_lembaga` = $idlembaga GROUP BY `payroll_detail_transaksi`.`id_transaksi`")->result();
		return $query;
	}


	
  }

	
?>
