<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_template extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	  // $this->load->model('M_karyawan');
	 }
	
	
	function cari_komponen($id){
		$this->db->join('lembaga','lembaga.id_lembaga = payroll_teamplate.id_lembaga');
        $this->db->join('karyawan', 'karyawan.nip_karyawan = payroll_teamplate.nip_karyawan','left');
        $this->db->join('unit_kerja', 'unit_kerja.id_unit_kerja = payroll_teamplate.id_unit_kerja','left');
        $this->db->join('payroll_detail_template', 'payroll_detail_template.id_teamplate = payroll_teamplate.id_teamplate','left');
        $this->db->where('payroll_teamplate.id_teamplate',$id);
       	$query=$this->db->get('payroll_teamplate')->row();
        return $query;
	}

  }

	
?>
