<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_pengguna extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	 }

	//========== MENU ROLE ========= 
    function tampil_menu_role(){
		$this->db->order_by('id_menu_role');
		$hsl=$this->db->get('menu_role');
		return $hsl;
	}

	function ubah_menu_role($kode,$datarole){
		$this->db->where('id_menu_role',$kode);
		$hsl=$this->db->update('menu_role',$datarole);
		return $hsl;
	}

	function tambah_menu_role($datarole){
		$hsl = $this->db->insert('menu_role',$datarole);
		return $hsl;
	}
	
	 function hapus_menu_role($kode){
		$this->db->where('id_menu_role',$kode);
		$hsl=$this->db->delete('menu_role');
		return $hsl;
	}
	
	function get_menu_role($id)
	{
		$this->db->where('id_menu_role',$id);
		$this->db->order_by('id_menu_role');
		$hsl= $this->db->get('menu_role');
		return $hsl;
	}
	//========== END MENU ROLE ========= 


	//========== MENU ========= 
    function tampil_menu(){
		
	  $this->db->select('id,parent_id,nama_menu,url,menu_order,status,icon,IF(parent_id = 0, "parent_menu",
	  getnamamenu(parent_id))AS parent_menu');
		$this->db->from('menu');
		$this->db->order_by('parent_id,menu_order');
		$hsl= $this->db->get();
		return $hsl;
	}

	function ubah_menu($kode,$datamenu){
		$this->db->where('id',$kode);
		$hsl=$this->db->update('menu',$datamenu);
		return $hsl;
	}

	function tambah_menu($datamenu){
		$hsl = $this->db->insert('menu',$datamenu);
		return $hsl;
	}
	
	 function hapus_menu($kode){
		$this->db->where('id',$kode);
		$hsl=$this->db->delete('menu');
		return $hsl;
	}
	
	function get_menu($id)
	{
		$this->db->where('id',$id);
		$this->db->order_by('id');
		$hsl= $this->db->get('menu_role');
		return $hsl;
	}
	//========== MENU ========= 


	//========== HAK AKSES MENU =============
	public function tampil_menu_akses(){
		$this->db->order_by('parent_id,menu_order');
		$this->db->where('menu.id_menu_role',1);
		$this->db->select(' menu.`menu_order`,menu.`nama_menu`, menu.`url`,getnamamenu(parent_id)as parent_menu,
    ,menu.`id`,IF(menu_akses.`id` IS NOT NULL, 1, 0)AS tampil,COALESCE(menu_akses.`flag_tambah`,0,1)AS tambah,COALESCE(menu_akses.`flag_ubah`,0,1)AS ubah,COALESCE(menu_akses.`flag_hapus`,0,1)AS hapus');
		$this->db->from('menu');
		$this->db->join('menu_akses','menu_akses.id_role=menu.id_menu_role','left');
		$hsl= $this->db->get();
		return $hsl;
  }

	//========== END HAK AKSES MENU =============

	public function make_query_akses($idrole){
		$this->db->order_by('menu.parent_id,menu.menu_order');
		$this->db->select('menu.`id` as id_menu,menu.`parent_id`,menu_akses.`id_role`,menu.`menu_order`,menu.`nama_menu`, menu.`url`,COALESCE(getnamamenu(menu.parent_id),"< parent >")as parent_menu,
    ,trim(menu_akses.`id`)as id,IF(menu_akses.`id` IS NOT NULL, 1, 0)AS tampil,COALESCE(menu_akses.`flag_tambah`,0,1)AS tambah,COALESCE(menu_akses.`flag_ubah`,0,1)AS ubah,COALESCE(menu_akses.`flag_hapus`,0,1)AS hapus');
		$this->db->from('menu');
		$this->db->join('menu_akses','menu.id=menu_akses.id_menu and  menu_akses.id_role = '.$idrole.'','left');

	}
	
	function get_filtered_data($idrole){  
			$this->make_query_akses($idrole);  
			$query = $this->db->get();  
			return $query->num_rows();  
	}       

	function make_datatables($idrole){  
		
		$this->make_query_akses($idrole);  

		$query = $this->db->get(); 

		return $query->result();  

	}  

	public function getHak($idmenu,$idrole)
	{
		$db = $this->db->get_where('menu_akses', array('id_menu'=>$idmenu,'id_role'=>$idrole));
		$result = $db->result();
		return $result;
	}

	public function update($data,$id)
		{
			$this->db->where('id_menu',$id);
			$hsl=$this->db->update('menu_akses',$data);
			return $hsl;
		}



	// FUNGSI UNTUK  CREATE USER 

	public function get_all_pengguna(){

		$this->db->select('getnamarole(user_admin.`id_role`)as namarole,getnamalembaga(karyawan.`id_lembaga`)as namalembaga, karyawan.`nama_karyawan`,user_admin.`pin`,user_admin.`pass`,user_admin.`status_user`,user_admin.`user_name`, user_admin.`id_role`,user_admin.`akses_antar_lembaga`,user_admin.`id_pengguna`,user_admin.`id_lembaga`,user_admin.`nip_karyawan`,user_admin.`akses_antar_lembaga`,karyawan.`id_karyawan`');
		$this->db->from('user_admin');
		$this->db->where('user_admin.sts_data','0');
		$this->db->join('karyawan','karyawan.`id_karyawan`= user_admin.`id_karyawan`');
		$hsl= $this->db->get();
		return $hsl;	
	}

	public function get_pengguna($kode){

		$this->db->select('getnamarole(user_admin.`id_role`)as namarole,getnamalembaga(karyawan.`id_lembaga`)as namalembaga, karyawan.`nama_karyawan`,user_admin.`pin`,user_admin.`pass`,user_admin.`status_user`,user_admin.`user_name`, user_admin.`id_role`,user_admin.`akses_antar_lembaga`,user_admin.`id_pengguna`,user_admin.`id_lembaga`,user_admin.`nip_karyawan`,user_admin.`akses_antar_lembaga`,karyawan.`id_karyawan`');
		$this->db->from('user_admin');
		$this->db->where('user_admin.sts_data','0');
		$this->db->where('id_pengguna',$kode);
		$this->db->join('karyawan','karyawan.`id_karyawan`= user_admin.`id_karyawan`');
		$hsl= $this->db->get();
		return $hsl;	
	}

	public function simpan_pengguna($data){
		$hsl = $this->db->insert('user_admin',$data);
		return $hsl;
	}

	public function ubah_pengguna($kode,$data){
		$this->db->where('id_pengguna',$kode);
		$hsl=$this->db->update('user_admin',$data);
		return $hsl;
	}

	public function hapus_pengguna($kode,$data){
		$this->db->where('id_pengguna',$kode);
		$hsl=$this->db->update('user_admin',$data);
		return $hsl;
		
	}

	public function reset_password($id,$data){
		$this->db->where('id_pengguna',$id);
		$hsl=$this->db->update('user_admin',$data);
		return $hsl;

	}
}
	
?>
