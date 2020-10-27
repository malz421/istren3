<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_laporanabsen extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	  $this->load->model('M_karyawan');
	 }
	
	function rekap_absen_karyawan($idkaryawan,$tglawal,$tglakhir){
			$this->db->select('getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","A")jmlalpa,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","I")jmlijin,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","S")jmlsakit,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","A")jmlalpa,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","C")jmlcuti,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","T")jmltugas,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","H")jmlhadir,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","HT")jmlhadirterlambat,getnamalembaga(id_lembaga) AS nama_lembaga,getnamaunitkerja(id_unit_kerja) AS unit_kerja,karyawan.nama_karyawan,absen_karyawan.id_absen_karyawan,absen_karyawan.id_karyawan,nip_karyawan,karyawan.nama_karyawan,DATE_FORMAT(tgl_absen,"%d-%m-%Y")as tgl_absen,DATE_FORMAT(jam_masuk, "%H:%i")jam_masuk,DATE_FORMAT(jam_keluar, "%H:%i")jam_keluar,absen_karyawan.id_sts_hadir,absen_karyawan.ket_hadir,absen_karyawan.ket_pulang,getmenitkeluar(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'")menitkeluar,getmenitmasuk(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'")menitmasuk,menit_lebih_masuk,menit_lebih_keluar');
			$this->db->from('absen_karyawan');
			$this->db->where('absen_karyawan.id_karyawan',$idkaryawan);
			$this->db->where('tgl_absen >=', $tglawal);
			$this->db->where('tgl_absen <=', $tglakhir);
			$this->db->join('karyawan','karyawan.id_karyawan=absen_karyawan.id_karyawan');
			$this->db->order_by('tgl_absen');
			$hsl = $this->db->get();
			return $hsl;
	}

	function exp_absen_karyawan($idkaryawan,$tglawal,$tglakhir){
		$this->db->select('getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","A")jmlalpa,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","I")jmlijin,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","S")jmlsakit,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","A")jmlalpa,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","C")jmlcuti,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","T")jmltugas,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","H")jmlhadir,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","HT")jmlhadirterlambat,getnamalembaga(id_lembaga) AS nama_lembaga,getnamaunitkerja(id_unit_kerja) AS unit_kerja,karyawan.nama_karyawan,absen_karyawan.id_absen_karyawan,absen_karyawan.id_karyawan,nip_karyawan,karyawan.nama_karyawan,DATE_FORMAT(tgl_absen,"%d-%m-%Y")as tgl_absen,DATE_FORMAT(jam_masuk, "%H:%i")jam_masuk,DATE_FORMAT(jam_keluar, "%H:%i")jam_keluar,absen_karyawan.id_sts_hadir,absen_karyawan.ket_hadir,absen_karyawan.ket_pulang,getmenitkeluar(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'")menitkeluar,getmenitmasuk(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'")menitmasuk,menit_lebih_masuk,menit_lebih_keluar');
		$this->db->from('absen_karyawan');
		$this->db->where('absen_karyawan.id_karyawan',$idkaryawan);
		$this->db->where('tgl_absen >=', $tglawal );
		$this->db->where('tgl_absen <=', $tglakhir);
		$this->db->join('karyawan','karyawan.id_karyawan=absen_karyawan.id_karyawan');
		$this->db->order_by('tgl_absen');
		$hsl = $this->db->get();
		return $hsl;
	
}

	function exp_absen_unitkerja($idunitkerja,$tglawal,$tglakhir){
		
		$this->db->select('getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","A")jmlalpa,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","I")jmlijin,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","S")jmlsakit,getcountstshadir(absen_karyawan.id_karyawan,"'.$tglawal.'","'.$tglakhir.'","A")jmlalpa,getnamalembaga(id_lembaga) AS nama_lembaga,getnamaunitkerja(id_unit_kerja) AS unit_kerja,karyawan.nama_karyawan,absen_karyawan.id_absen_karyawan,absen_karyawan.id_karyawan,nip_karyawan,karyawan.nama_karyawan,DATE_FORMAT(tgl_absen,"%d-%m-%Y")as tgl_absen,DATE_FORMAT(jam_masuk, "%H:%i")jam_masuk,DATE_FORMAT(jam_keluar, "%H:%i")jam_keluar,absen_karyawan.id_sts_hadir,absen_karyawan.ket_hadir,absen_karyawan.ket_pulang');
		$this->db->from('absen_karyawan');
		$this->db->where('absen_karyawan.id_unit_kerja',$idunitkerja);
		$this->db->where('tgl_absen >=', $tglawal);
		$this->db->where('tgl_absen <=', $tglakhir);
		$this->db->join('karyawan','karyawan.id_karyawan=absen_karyawan.id_karyawan');
		$this->db->order_by('tgl_absen');
		$hsl = $this->db->get();
		return $hsl;
	}

	

	function detail_absen($idabsen){
	
		$this->db->select('getnamalembaga(id_lembaga) AS nama_lembaga,getnamaunitkerja(id_unit_kerja) AS unit_kerja,karyawan.nama_karyawan,absen_karyawn.id_absen_karyawan,absen_karyawan.id_karyawan,nip_karyawan,karyawan.nama_karyawan,DATE_FORMAT(tgl_absen,"%d-%m-%Y")as tgl_absen,DATE_FORMAT(jam_masuk, "%H:%i")jam_masuk,DATE_FORMAT(jam_keluar, "%H:%i")jam_keluar,absen_karyawan.id_sts_hadir,absen_karyawan.ket_hadir,absen_karyawan.ket_pulang');
		$this->db->from('absen_karyawan');
		$this->db->where('absen_karyawan.id_absen_karyawan',$idabsen);
		$this->db->join('karyawan','karyawan.id_karyawan=absen_karyawan.id_karyawan');
		$this->db->order_by('tgl_absen');

		$hsl = $this->db->get();
		return $hsl;
	
	}

	function hapus_absen($idabsen,$data){
		$this->db->where('id_absen_karyawan',$idabsen);
		$hsl=$this->db->update('absen_karyawan',$data);
		return $hsl;
	}

	public function ubah_absen($idabsen,$data){
		$this->db->where('id_absen_karyawan',$idabsen);
		$hsl=$this->db->update('absen_karyawan',$data);
		return $hsl;
	}

	public function TampilRekapAbsensiTglId($tgl1,$idkaryawan){

		$this->db->select('*');
		$this->db->where_in('id_karyawan',$idkaryawan);
		$this->db->where('tgl_absen =',$tgl1);
		$this->db->order_by('tgl_absen');
		$hsl = $this->db->get('absen_karyawan');
		$this->db->order_by('tgl_absen');
		return $hsl->row_array();

	}

	function getakumabsen($idkaryawan, $tglawal, $tglakhir)	
{
    $this->db->select('getcountstshadir(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '","A")jmlalpa,getcountstshadir(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '","I")jmlijin,getcountstshadir(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '","S")jmlsakit,getcountstshadir(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '","A")jmlalpa,getcountstshadir(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '","C")jmlcuti,getcountstshadir(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '","T")jmltugas,getcountstshadir(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '","H")jmlhadir,getcountstshadir(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '","HT")jmlhadirterlambat,getmenitkeluar(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '")menitkeluar,getmenitmasuk(absen_karyawan.id_karyawan,"' . $tglawal . '","' . $tglakhir . '")menitmasuk');
    $this->db->from('absen_karyawan');
    $this->db->where('absen_karyawan.id_karyawan', $idkaryawan);
    $this->db->where('tgl_absen >=', $tglawal);
    $this->db->where('tgl_absen <=', $tglakhir);
	$this->db->order_by('tgl_absen');
	$this->db->distinct();
    $hsl = $this->db->get();
    return $hsl->row_array();
}


	
  }

	
?>
