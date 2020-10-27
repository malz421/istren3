<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_combo extends CI_Model{
	
	public function __construct()
	 {
	  parent::__construct();
			 //$this->db2 = $this->load->database('jbs', TRUE);
	 }

	public function combolembaga($id)
	{
		//Jika role akses admin 
		if ($id == 'all'){
		    $this->db->order_by('id_lembaga');
			$hasil=$this->db->get('lembaga');
			if ($hasil->num_rows()> 0 )
			{
				return $hasil->result();
			}
		}
		else
		{
			$this->db->order_by('id_lembaga');
			$hasil=$this->db->get_where('lembaga',array('id_lembaga' => $id));
			if ($hasil->num_rows()> 0 )
			{
				return $hasil->result();
			}
		}
	}  


	public function combomenu()
	{
		$this->db->select('id,parent_id,nama_menu,url,menu_order,status,icon,getnamamenu(id)as parent_menu');
		$this->db->from('menu');
		$this->db->order_by('parent_id,id,menu_order');
		$hsl= $this->db->get();
		if ($hsl->num_rows()> 0 )
		{
			return $hsl->result();
		}
		
	}

	public function combohakakses()
	{
		//Jika role akses admin 
		
		$this->db->order_by('id_menu_role');
		$hasil=$this->db->get('menu_role');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combopengguna()
	{
		//Jika role akses admin 
		
		$this->db->order_by('nama_karyawan');
		$hasil=$this->db->get('karyawan');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combogoldarah()
	{
		//Jika role akses admin 
		
		$this->db->order_by('id');
		$hasil=$this->db->get('gol_darah');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combonikah()
	{
		
		$this->db->order_by('id_sts_nikah');
		$hasil=$this->db->get('status_nikah');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combounitkerja()
	{
		$this->db->order_by('id_unit_kerja');
		$hasil=$this->db->get('unit_kerja');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combostatuskaryawan()
	{
		$this->db->order_by('id_sts_karyawan');
		$hasil=$this->db->get('status_karyawan');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combostatuskerja()
	{
		$this->db->order_by('id_sts_karyaaktif');
		$hasil=$this->db->get('status_aktif_karyawan');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combostatustinggal()
	{
		$this->db->order_by('id_sts_tinggal');
		$hasil=$this->db->get('status_tinggal');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combopekerjaan()
	{
		$this->db->order_by('id_kerja');
		$hasil=$this->db->get('jenis_pekerjaan');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

		public function combojabatan()
	{
		$this->db->order_by('id_jabatan');
		$hasil=$this->db->get('jenis_jabatan');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combopendidikan()
	{
		$this->db->order_by('id_pendidikan');
		$hasil=$this->db->get('jenis_pendidikan');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function combohubungan()
	{
		$this->db->order_by('id_hubungan');
		$hasil=$this->db->get('jenis_hubungan');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}

	public function comboshift()
	{
		$this->db->order_by('nama_shift');
		$hasil=$this->db->get('absen_shift');
		if ($hasil->num_rows()> 0 )
		{
			return $hasil->result();
		}
	}



}    