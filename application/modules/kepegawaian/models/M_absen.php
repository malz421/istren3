<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_absen extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }

	 //cek data ada atu tidak ada
	public function isExists($valkey,$tabel){
		$this->db->from($tabel);
		$this->db->where($valkey);
		$num = $this->db->count_all_results();
		if($num == 0)
		{
			return FALSE;
		}else{
			return TRUE;
		}
	}

    //format tanggal jadi Y-m-d
	public function rubah_tglformat($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) 
		{
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	//format tanggal jadi tgl-bulan-tahun
	public function format_indo($date){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tahun = substr($date, 0, 4);               
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
		$result = $tgl."-".$bulan."-".$tahun;
		return($result);
	}
	
	//format tanggal jadi tgl-namabulan-tahun
	public  function tgl_indo($date){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tahun = substr($date, 0, 4);               
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
		$result = $tgl . "-" . $BulanIndo[(int)$bulan-1]. "-". $tahun;
		//$result = $tgl."-".$bulan."-".$tahun;
		return($result);
	}
	
    //data karyawan datatables
	public function getKaryawan($idlembaga,$idunit)
	{
		$this->datatables->select('id_karyawan,nip_karyawan,nama_karyawan');
		$this->datatables->from('karyawan');
		if ($idlembaga !== null) {
			$this->datatables->where('id_lembaga', $idlembaga);
		}

		if ($idunit !== null) {
			$this->datatables->where('id_unit_kerja', $idunit);
		}
		return $this->datatables->generate();
	}

	//Simpan absen shift
	public function simpan_absen_shift($data)
	{
		$hsl = $this->db->insert('absen_shift_karyawan', $data);
		return $hsl;
	}

    //delete absen shift
	public function delete_absen_shift($data)
	{
		$hsl = $this->db->delete('absen_shift_karyawan', $data);
		return $hsl;
	}

	public function TampilShift($idshift,$tgl1,$tgl2,$idkaryawan){
		$this->db->select('*');
		$this->db->where_in('id_karyawan',$idkaryawan);
		$this->db->where('kode_shift',$idshift);
		$this->db->where('tgl_absen >=',$tgl1);
		$this->db->where('tgl_absen <=',$tgl2);
		$this->db->order_by('id_karyawan');
		$hsl = $this->db->get('absen_shift_karyawan');
		return $hsl->result();
	}

		public function TampilShiftAll($tgl1,$idkaryawan){
		$this->db->select('*,getketshift(kode_shift)namashift');
		$this->db->where_in('id_karyawan',$idkaryawan);
		$this->db->where('tgl_absen =',$tgl1);
		$this->db->order_by('id_karyawan');
		$hsl = $this->db->get('absen_shift_karyawan');
		return $hsl->row_array();
	}

	public function TampilShiftBulan($tgl,$idkaryawan){
		$this->db->select('*,getketshift(kode_shift)namashift');
		$this->db->where_in('id_karyawan',$idkaryawan);
		$this->db->where('DATE_FORMAT("tgl_absen", "%Y%m")',$tgl);
		$this->db->order_by('tgl_absen');
		$hsl = $this->db->get('absen_shift_karyawan');
		return $hsl->row_array();
	}


	 public function getKaryawanMulti($data){
        $this->db->select('id_karyawan,nama_karyawan');
        $this->db->from('karyawan');
        $this->db->where('sts_data', 0);
        $this->db->where_in('id_karyawan', $data);
        $this->db->order_by('id_karyawan');
		$hsl = $this->db->get();
		return $hsl->result();
	}
	
	public function HapusShiftId($id){
		$this->db->where('id_shift_karyawan', $id);
        $hsl = $this->db->delete('absen_shift_karyawan');
		return $hsl;
	}
	
	//Tampil Absen Polas
	function tampil_absen_pola()
	{
		$this->db->order_by('id_shift');
		$hsl = $this->db->get('absen_shift');
		return $hsl->result();
	}



	function TampilAkumAbsen($tgl1, $tgl2, $idkaryawan)
		{
			$this->db->select('id_sts_hadir,count(id_sts_hadir)as Jumlah');
			$this->db->where_in('id_karyawan', $idkaryawan);
			$this->db->where('tgl_absen =', $tgl1);
			$this->db->order_by('id_karyawan');
			$hsl = $this->db->get('absen_karyawan');
			return $hsl->result();
		}

  }


?>
