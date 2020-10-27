<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function __construct()
	 {
	  parent::__construct();
			
     }

	//Periksa Login Admin
	function login_admin($u,$p)
	{
	/* 	$kondisi = array(
			'user_name' => $u,
			);
		
		$kondisi2 = array(
			'nip_karyawan' => $u,
			);
			
	    $this->db->where($kondisi);
		$this->db->or_where($kondisi2);
		$query = $this->db->get('karyawan');
		return  $query; */


		 $kondisi = array(
			'`user_admin`.`user_name`' => $u,
			);
		
		 $kondisi2 = array(
			'`user_admin`.`nip_karyawan`' => $u,
			);

			$this->db->select('user_admin.id_pengguna` as idpengguna,karyawan.`id_karyawan`,karyawan.`id_departemen`,karyawan.`id_lembaga`, karyawan.`nama_karyawan`,user_admin.`pin`,user_admin.`pass`,user_admin.`status_user`,user_admin.`user_name`, karyawan.`nik_karyawan`, user_admin.`id_role`, user_admin.`akses_antar_departemen`,user_admin.`akses_antar_lembaga`');
			$this->db->from('user_admin');
			$this->db->join('karyawan','karyawan.`id_karyawan`= user_admin.`id_karyawan`');
			$this->db->where($kondisi);
			$this->db->or_where($kondisi2);
			$query = $this->db->get();
			return  $query; 
	}

	function login_user($u, $p)
{
    
    $kondisi = array(
        '`no_hp`' => $u,
    );

    $kondisi2 = array(
        '`nip_karyawan`' => $u,
    );

    $this->db->select('karyawan.`id_karyawan` as idpengguna,karyawan.`pin`,karyawan.`pass`,karyawan.`id_departemen`,karyawan.`id_lembaga`, karyawan.`nama_karyawan`');
    $this->db->from('karyawan');
	$this->db->where($kondisi);
	$this->db->or_where($kondisi2);
    $query = $this->db->get();
    return $query;
}




}

/* End of file model_login.php */
/* Location: ./application/models/model_login.php */