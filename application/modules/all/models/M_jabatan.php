<?php 

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_jabatan extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }
	
	function tampil_jabatan(){
		$hsl=$this->db->get('jenis_jabatan');
		return $hsl;
	}
	
	function detil_jabatan($id){
		$this->db->where('id_jabatan',$id);
		$hsl=$this->db->get('jenis_jabatan');
		return $hsl;
	}
	
	function tambah_jabatan($data){
		$hsl=$this->db->insert('jenis_jabatan',$data);
		return $hsl;
	}

	function ubah_jabatan($id,$data){
		$this->db->where('id_jabatan',$id);
		$hsl=$this->db->update('jenis_jabatan',$data);
		return $hsl;
	}
	
	function hapus_jabatan($id){
		$this->db->where('id_jabatan',$id);
		$hsl=$this->db->delete('jenis_jabatan');
		return $hsl;
	}
  }
	
?>
