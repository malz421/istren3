<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_departemen extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }
	
	function tampil_departemen($id){
		
		if ($id=='all'){ 
		$hsl=$this->db->query("SELECT a.nama_lembaga,b.*
						FROM lembaga a,departemen b
						WHERE a.id_lembaga = b.id_lembaga");
						
		}
		else
		{
			$hsl=$this->db->query("SELECT a.nama_lembaga,b.*
						FROM lembaga a,departemen b
						WHERE a.id_lembaga = b.id_lembaga
						and a.id_lembaga= ".$id."");
						
		}
		return $hsl;
	}
	
	function detil_departemen($id){
		$hsl=$this->db->query("SELECT a.nama_lembaga,b.*
							FROM lembaga a,departemen b
							WHERE a.id_lembaga = b.id_lembaga 
							and id_departemen = $id");
		return $hsl;
	}
	
	function tambah_departemen($data){
		$hsl=$this->db->insert('departemen',$data);
		return $hsl;
	}

	function ubah_departemen($id,$data){
		$this->db->where('id_departemen',$id);
		$hsl=$this->db->update('departemen',$data);
		return $hsl;
	}
	
	function hapus_departemen($id){
		$this->db->where('id_departemen',$id);
		$hsl=$this->db->delete('departemen');
		return $hsl;
	}
  }
	
?>
