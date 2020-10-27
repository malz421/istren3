<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_kode_unik extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }

public function buat_kode()   {
			$this->db->select('RIGHT(komponen_gaji.id_komponen,4) as kode', FALSE);
			$this->db->order_by('id_komponen','DESC');    
			$this->db->limit(1);    
		  $query = $this->db->get('komponen_gaji');      //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
		  	$data = $query->row();      
		  	$kode = intval($data->kode) + 1;    
		  }
		  else {      
		   //jika kode belum ada      
		  	$kode = 1;    
		  }
		  $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "889-".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		  return $kodejadi;  
	}

  }


?>
