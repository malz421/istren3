<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_lembaga extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }
	
	function tampil_lembaga(){
		$hsl=$this->db->get('lembaga');
		return $hsl;
	}
	
	function detil_lembaga($id){
		$this->db->where('id_lembaga',$id);
		$hsl=$this->db->get('lembaga');
		return $hsl;
	}
	
	function tambah_lembaga($datalembaga){
		$hsl=$this->db->insert('lembaga',$datalembaga);
		return $hsl;
	}

	function ubah_lembaga($id,$datalembaga){
		$this->db->where('id_lembaga',$id);
		$hsl=$this->db->update('lembaga',$datalembaga);
		return $hsl;
	}
	
	function hapus_lembaga($id){
		$this->db->where('id_lembaga',$id);
		$hsl=$this->db->delete('lembaga');
		return $hsl;
	}
  }
	
?>
