<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_absen extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }
	
	// START ABSEN_UMUM
	function tampil_absen_umum($id){
		
		if ($id=='all'){ 
		$hsl=$this->db->query("SELECT a.nama_lembaga,b.*,DATE_FORMAT(b.jam_masuk, '%h:%i') as jammasuk,DATE_FORMAT(b.jam_keluar, '%h:%i') as jamkeluar
						FROM lembaga a,absen_umum b
						WHERE a.id_lembaga = b.id_lembaga");
						
		}
		else
		{
			$hsl=$this->db->query("SELECT a.nama_lembaga,b.*,DATE_FORMAT(b.jam_masuk, '%h:%i') as jammasuk,DATE_FORMAT(b.jam_keluar, '%h:%i') as jamkeluar
						FROM lembaga a,absen_umum b
						WHERE a.id_lembaga = b.id_lembaga
						and a.id_lembaga= ".$id."");
						
		}
		return $hsl;
	}
	
	function detil_absen_umum($id){
		$hsl=$this->db->query("SELECT a.nama_lembaga,b.*,DATE_FORMAT(b.jam_masuk, '%h:%i') as jammasuk,DATE_FORMAT(b.jam_keluar, '%h:%i') as jamkeluar
							FROM lembaga a,absen_umum b
							WHERE a.id_lembaga = b.id_lembaga 
							and id_absen_umum = $id");
		return $hsl;
	}
	
	function tambah_absen_umum($data){
		$hsl=$this->db->insert('absen_umum',$data);
		return $hsl;
	}

	function ubah_absen_umum($id,$data){
		$this->db->where('id_absen_umum',$id);
		$hsl=$this->db->update('absen_umum',$data);
		return $hsl;
	}
	
	function hapus_absen_umum($id){
		$this->db->where('id_absen_umum', $id);
		$hsl = $this->db->delete('absen_umum');
		return $hsl;
	}
	// END ABSEN_UMUM
	  



  	// START ABSEN_POLA 
  	function tampil_absen_pola(){
		$this->db->order_by('kode_shift');
		$hsl = $this->db->get('absen_shift');
		return $hsl;
	}
	
	function detil_absen_pola($id){
		$this->db->where('kode_shift','$id');
		$hsl = $this->db->get('absen_shift');
		return $hsl;
	}
	
	function tambah_absen_pola($data){
		$hsl=$this->db->insert('absen_shift',$data);
		return $hsl;
	}

	function ubah_absen_pola($id,$data){
		$this->db->where('id_shift',$id);
		$hsl=$this->db->update('absen_shift',$data);
		return $hsl;
	}
	
	function hapus_absen_pola($id){
		$this->db->where('id_shift',$id);
		$hsl = $this->db->delete('absen_shift');
		return $hsl;
	}
	// END ABSEN_POLA
	  


}