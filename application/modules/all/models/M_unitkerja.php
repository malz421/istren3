<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_unitkerja extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }
	
	function tampil_unitkerja(){
		$hsl=$this->db->get('unit_kerja');
		return $hsl;
	}
	
	function detil_unitkerja($id){
		$this->db->where('id_unit_kerja',$id);
		$hsl=$this->db->get('unit_kerja');
		return $hsl;
	}
	
	function tambah_unitkerja($data){
		$hsl=$this->db->insert('unit_kerja',$data);
		return $hsl;
	}

	function ubah_unitkerja($id,$data){
		$this->db->where('id_unit_kerja',$id);
		$hsl=$this->db->update('unit_kerja',$data);
		return $hsl;
	}
	
	function hapus_unitkerja($id){
		$this->db->where('id_unit_kerja',$id);
		$hsl=$this->db->delete('unit_kerja');
		return $hsl;
	}
  }
	
?>
