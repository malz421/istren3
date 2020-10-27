<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_level extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
			 //$this->db2 = $this->load->database('jbs', TRUE);
	 }

    function tampil_level(){
		$this->db->order_by('replid');
		$hsl=$this->db->get('user_level');
		return $hsl;
	}
	
	function cek_level(){
		$this->db->order_by('replid');
		$hsl=$this->db->get('user_level');
		return $hsl;
	}
	
	function hapus_level($kode){
		$this->db->where('replid',$kode);
		$hsl=$this->db->delete('user_level');
		return $hsl;
	}

	function ubah_level($kode,$datauser){
		$this->db->where('replid',$kode);
		$hsl=$this->db->update('user_level',$datauser);
		return $hsl;
	}

	function tambah_level($datauser){

		$hsl=$this->db->insert('user_level',$datauser);
		return $hsl;
	}

}
	
?>
