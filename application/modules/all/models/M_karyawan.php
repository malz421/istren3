<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_karyawan extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }
	
	function tampil_karyawan($id){
		
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
	
	function detil_karyawan($id){
		$hsl=$this->db->query("SELECT a.nama_lembaga,b.*
							FROM lembaga a,departemen b
							WHERE a.id_lembaga = b.id_lembaga 
							and id_departemen = $id");
		return $hsl;
	}
	
	function tambah_karyawan($data){
		$hsl=$this->db->insert('departemen',$data);
		return $hsl;
	}

	function ubah_karyawan($id,$data){
		$this->db->where('id_departemen',$id);
		$hsl=$this->db->update('departemen',$data);
		return $hsl;
	}
	
	function hapus_karyawan($id){
		$this->db->where('id_departemen',$id);
		$hsl=$this->db->delete('departemen');
		return $hsl;
	}

	public function reset_password($id,$data){
		$this->db->where('id_karyawan',$id);
		$hsl=$this->db->update('karyawan',$data);
		return $hsl;

	}
  }
	
?>
