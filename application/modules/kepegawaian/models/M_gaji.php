<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class M_gaji extends CI_Model
  {
    public function __construct()
	 {
	  parent::__construct();
	  // $this->load->model('M_karyawan');
	 }
	
	
	function tampil_gaji(){
		$this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan','left');
        $this->db->join('payroll_teamplate','payroll_teamplate.id_teamplate = payroll_transaksi.id_teamplate','left');
        $this->db->join('payroll_periode_gaji','payroll_periode_gaji.id_periode = payroll_transaksi.id_periode','left');
        $this->db->join('lembaga','lembaga.id_lembaga = karyawan.id_lembaga','left');
        $this->db->join('unit_kerja','unit_kerja.id_unit_kerja = karyawan.id_unit_kerja','left');
        $this->db->select('karyawan.nip_karyawan,karyawan.nama_karyawan,unit_kerja.nama_unit_kerja,payroll_teamplate.nama_teamplate,payroll_periode_gaji.nama_periode,karyawan.id_karyawan,payroll_teamplate.id_teamplate,payroll_transaksi.status,payroll_transaksi.create_at,payroll_teamplate.id_teamplate,karyawan.id_sts_karyawan,karyawan.tgl_berkerja');
        $gaji=$this->db->get('payroll_transaksi')->result();
        return $gaji;
	}

	// cek gaji perperiode
	function cek_gaji($id_karyawan,$id_periode,$id_teamplate){
        $this->db->where('id_karyawan',$id_karyawan);
        $this->db->where('id_periode',$id_periode);
        $this->db->where('id_teamplate',$id_teamplate);
        $query=$this->db->get('payroll_transaksi')->num_rows();
        return $query;
	}


	function tampil_kategori($id_teamplate){
		$this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');
        $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_detail_template.id_group_kategori_komponen');
        $this->db->where('payroll_detail_template.id_teamplate',$id_teamplate);
        $query=$this->db->get('payroll_detail_template')->result();
        return $query;
	}

	function tampil_semua_pegawai(){
		$this->db->join('lembaga','lembaga.id_lembaga=karyawan.id_lembaga','left');
        $this->db->join('unit_kerja','unit_kerja.id_unit_kerja=karyawan.id_unit_kerja','left');
        $query=$this->db->get('karyawan')->row();
        return $query;
	}

	function cari_kategori_perkaryawan($id_karyawan,$id_teamplate){
		$this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi= payroll_detail_transaksi.id_transaksi');
        $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_transaksi.id_komponen_gaji');
        $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_detail_transaksi.id_group_kategori_komponen');
        $this->db->where('payroll_transaksi.id_teamplate',$id_teamplate);
        $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
        $this->db->group_by("payroll_group_kategori_komponen.id_group_kategori_komponen");
        $query=$this->db->get('payroll_detail_transaksi')->result();
        return $query;
	}

	function cari_detail_karyawan($id_karyawan){
		$this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
		$this->db->join('lembaga','lembaga.id_lembaga=karyawan.id_lembaga','left');
		$this->db->join('unit_kerja', 'unit_kerja.id_unit_kerja = karyawan.id_unit_kerja','left');
		$this->db->join('payroll_teamplate','payroll_teamplate.id_teamplate=payroll_transaksi.id_teamplate');
		$this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi=payroll_transaksi.id_transaksi');
		$this->db->join('payroll_detail_template','payroll_detail_template.id_detail_template=payroll_detail_transaksi.id_detail_template','left');
		$this->db->join('payroll_periode_gaji','payroll_periode_gaji.id_periode = payroll_transaksi.id_periode');
		$this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
      	$query=$this->db->get('payroll_transaksi')->row();
        return $query;
	}

	function cari_gaji_perkaryawan_pendapatan($id_karyawan){
		$this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
      	$this->db->join('payroll_detail_template','payroll_detail_template.id_detail_template= payroll_detail_transaksi.id_detail_template');
      	$this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');
      	$this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
      	$this->db->join('payroll_periode_gaji','payroll_periode_gaji.id_periode = payroll_transaksi.id_periode');
      	$this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
      	$this->db->where('payroll_detail_transaksi.type','Penambahan');
      	$query=$this->db->get('payroll_transaksi')->result();
        return $query;
	}

		function cari_gaji_perkaryawan_potongan($id_karyawan){
		$this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
      	$this->db->join('payroll_detail_template','payroll_detail_template.id_detail_template= payroll_detail_transaksi.id_detail_template');
      	$this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');
      	$this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
      	$this->db->join('payroll_periode_gaji','payroll_periode_gaji.id_periode = payroll_transaksi.id_periode');
      	$this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
      	$this->db->where('payroll_detail_transaksi.type','Pengurangan');
      	$query=$this->db->get('payroll_transaksi')->result();
        return $query;
	}

	function cari_gaji_perkaryawan_informasi($id_karyawan){
		$this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
      	$this->db->join('payroll_detail_template','payroll_detail_template.id_detail_template= payroll_detail_transaksi.id_detail_template');
      	$this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');
      	$this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
      	$this->db->join('payroll_periode_gaji','payroll_periode_gaji.id_periode = payroll_transaksi.id_periode');
      	$this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
      	$this->db->where('payroll_detail_transaksi.type','Perusahaan');
      	$query=$this->db->get('payroll_transaksi')->result();
        return $query;
	}

	function tampil_pegawai(){
		$this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
	    $this->db->join('payroll_periode_gaji','payroll_periode_gaji.id_periode = payroll_transaksi.id_periode');
	    $query=$this->db->get('payroll_transaksi')->row();
	    return $query;
	}
  }

	
?>
