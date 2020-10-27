<?php 

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_kalender extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }
	
	function tampil_kalender(){
		$this->db->select('*,getnamalembaga(id_lembaga) AS nama_lembaga');
		$hsl=$this->db->get('hari_libur');
		return $hsl;
	}
	
	function detil_kalender($id){
		$this->db->where('id_kalender',$id);
		$hsl=$this->db->get('hari_libur');
		return $hsl;
	}
	
	function tambah_kalender($data){
		$hsl=$this->db->insert('hari_libur',$data);
		return $hsl;
	}

	function ubah_kalender($id,$data){
		$this->db->where('id_kalender',$id);
		$hsl=$this->db->update('hari_libur',$data);
		return $hsl;
	}
	
	function hapus_kalender($id){
		$this->db->where('id_kalender',$id);
		$hsl=$this->db->delete('hari_libur');
		return $hsl;
	}
  }
	
?>
