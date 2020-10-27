<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_karyawan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
    }

    public function getDataKaryawan($idlembaga)
    {
        $this->datatables->select('id_karyawan,nik_karyawan,nip_karyawan,nama_karyawan,jenis_kelamin,getnamalembaga(id_lembaga) AS nama_lembaga,getnamaunitkerja(id_unit_kerja) AS unit_kerja');
        $this->datatables->from('karyawan');
        $this->datatables->where('sts_data', 0);
        if ($idlembaga !== null) {
            $this->datatables->where('id_lembaga', $idlembaga);
        }
        return $this->datatables->generate();
    }

    public function tampil_karyawan($idlembaga)
    {

        if ($idlembaga == 'all') {

            $this->db->select('*,getnamalembaga(id_lembaga) AS nama_lembaga,getnamaunitkerja(id_unit_kerja) AS unit_kerja,getnamadepartemen(id_departemen) AS nama_departemen');
            $this->db->from('karyawan');
            $this->db->where('sts_data', 0);
            $this->db->order_by('nama_karyawan');
            $hsl = $this->db->get();

        } else {
            $this->db->select('*,getnamalembaga(id_lembaga) AS nama_lembaga,getnamaunitkerja(id_unit_kerja) AS unit_kerja,getnamadepartemen(id_departemen) AS nama_departemen');
            $this->db->from('karyawan');
            $this->db->where('id_lembaga', $idlembaga);
            $this->db->where('sts_data', 0);
            $this->db->order_by('nama_karyawan');
            $hsl = $this->db->get();
        }
        return $hsl;
    }

    public function detail_karyawan($id)
    {
        $this->db->select('*,getnamalembaga(id_lembaga) AS namalembaga,getnamaunitkerja(1) AS unitkerja,getnamadepartemen(id_departemen) AS namadepartemen');
        $this->db->from('karyawan');
        $this->db->where('id_karyawan', $id);
        $hsl = $this->db->get();
        return $hsl;
    }

    public function detail_karyawan_nip($nip)
    {
        $this->db->select('nip_karyawan');
        $this->db->from('karyawan');
        $this->db->where('nip_karyawan', $nip);
        $hsl = $this->db->get();
        return $hsl;
    }

    public function tambah_karyawan($data)
    {
        $hsl = $this->db->insert('karyawan', $data);
        return $hsl;
    }

    public function hapus_karyawan($id, $data)
    {
        $this->db->where('id_karyawan', $id);
        $hsl = $this->db->update('karyawan', $data);
        return $hsl;
    }
    public function ubah_karyawan($kode, $data)
    {
        $this->db->where('id_karyawan', $kode);
        $hsl = $this->db->update('karyawan', $data);
        return $hsl;
    }

    public function get_nip($awalan)
    {
        $awalan = '01' . $awalan;
        $q = $this->db->query("SELECT MAX(RIGHT(nip_karyawan,3)) AS kd_max FROM karyawan WHERE MID(nip_karyawan,1,8)= $awalan");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return $awalan . $kd;
    }
    /*  KELUARGA */

    public function getDataKeluarga($nip)
    {
        $this->datatables->select('*,getnamapekerjaan(id_pekerjaan)namapekerjaan,getnamapendidikan(id_pendidikan)namapendidikan,getnamahubungan(id_hubungan)namahubungan');
        $this->datatables->from('karyawan_keluarga');
        $this->datatables->where('nip_karyawan', $nip);
        return $this->datatables->generate();
    }

    public function data_keluarga($nip)
    {
        $this->db->where('nip_karyawan', $nip);
        $hsl = $this->db->get('karyawan_keluarga');
        return $hsl;
    }

    public function detail_keluarga($idkel)
    {
        $this->db->where('id_keluarga', $idkel);
        $hsl = $this->db->get('karyawan_keluarga');
        return $hsl;
    }

    public function simpan_keluarga($data)
    {
        $hsl = $this->db->insert('karyawan_keluarga', $data);
        return $hsl;
    }

    public function ubah_keluarga($idkel, $data)
    {
        $this->db->where('id_keluarga', $idkel);
        $hsl = $this->db->update('karyawan_keluarga', $data);
        return $hsl;
    }

    public function hapus_keluarga($idkel)
    {
        $this->db->where('id_keluarga', $idkel);
        $hsl = $this->db->delete('karyawan_keluarga');
        return $hsl;
    }
    /* END KELUARGA */

    /*  PENDIDIKAN */

    public function getDataPendidikan($nip)
    {
        $this->datatables->select('*,getnamapendidikan(id_pendidikan)namapendidikan');
        $this->datatables->from('karyawan_sekolah');
        $this->datatables->where('nip_karyawan', $nip);
        return $this->datatables->generate();
    }

    public function data_pendidikan($nip)
    {
        $this->db->where('nip_karyawan', $nip);
        $hsl = $this->db->get('karyawan_sekolah');
        return $hsl;
    }

    public function detail_pendidikan($id)
    {
        $this->db->where('id_sekolah', $id);
        $hsl = $this->db->get('karyawan_sekolah');
        return $hsl;
    }

    public function simpan_pendidikan($data)
    {
        $hsl = $this->db->insert('karyawan_sekolah', $data);
        return $hsl;
    }

    public function ubah_pendidikan($id, $data)
    {
        $this->db->where('id_sekolah', $id);
        $hsl = $this->db->update('karyawan_sekolah', $data);
        return $hsl;
    }

    public function hapus_pendidikan($id)
    {
        $this->db->where('id_sekolah', $id);
        $hsl = $this->db->delete('karyawan_sekolah');
        return $hsl;
    }

    /* END PENDIDIKAN */


    /*  JABATAN */

    public function getDataJabatan($nip)
    {
        $this->datatables->select('*,getnamajabatan(id_jabatan)namajabatan');
        $this->datatables->from('karyawan_jabatan');
        $this->datatables->where('nip_karyawan', $nip);
        return $this->datatables->generate();
    }

    public function data_jabatan($nip)
    {
        $this->db->where('nip_karyawan', $nip);
        $hsl = $this->db->get('karyawan_sekolah');
        return $hsl;
    }

    public function detail_jabatan($id)
    {
        $this->db->where('id_jabatan_karyawan', $id);
        $hsl = $this->db->get('karyawan_jabatan');
        return $hsl;
    }

    public function simpan_jabatan($data)
    {
        $hsl = $this->db->insert('karyawan_jabatan', $data);
        return $hsl;
    }

    public function ubah_jabatan($id, $data)
    {
        $this->db->where('id_jabatan_karyawan', $id);
        $hsl = $this->db->update('karyawan_jabatan', $data);
        return $hsl;
    }

    public function hapus_jabatan($id)
    {
        $this->db->where('id_jabatan_karyawan', $id);
        $hsl = $this->db->delete('karyawan_jabatan');
        return $hsl;
    }

    /* END JABATAN */


    /*  RIWAYAT KERJA */

    public function getDataRiwayat($nip)
    {
        $this->datatables->select('*');
        $this->datatables->from('karyawan_kerja');
        $this->datatables->where('nip_karyawan', $nip);
        return $this->datatables->generate();
    }

    public function data_riwayat($nip)
    {
        $this->db->where('nip_karyawan', $nip);
        $hsl = $this->db->get('karyawan_kerja');
        return $hsl;
    }

    public function detail_riwayat($id)
    {
        $this->db->where('id_kerja', $id);
        $hsl = $this->db->get('karyawan_kerja');
        return $hsl;
    }

    public function simpan_riwayat($data)
    {
        $hsl = $this->db->insert('karyawan_kerja', $data);
        return $hsl;
    }

    public function ubah_riwayat($id, $data)
    {
        $this->db->where('id_kerja', $id);
        $hsl = $this->db->update('karyawan_kerja', $data);
        return $hsl;
    }

    public function hapus_riwayat($id)
    {
        $this->db->where('id_kerja', $id);
        $hsl = $this->db->delete('karyawan_kerja');
        return $hsl;
    }

    /* END RIWAYAT KERJA */




    /*  DIKLAT */

    public function getDataDiklat($nip)
    {
        $this->datatables->select('*');
        $this->datatables->from('karyawan_diklat');
        $this->datatables->where('nip_karyawan', $nip);
        return $this->datatables->generate();
    }

    public function data_diklat($nip)
    {
        $this->db->where('nip_karyawan', $nip);
        $hsl = $this->db->get('karyawan_diklat');
        return $hsl;
    }

    public function detail_diklat($id)
    {
        $this->db->where('id_diklat', $id);
        $hsl = $this->db->get('karyawan_diklat');
        return $hsl;
    }

    public function simpan_diklat($data)
    {
        $hsl = $this->db->insert('karyawan_diklat', $data);
        return $hsl;
    }

    public function ubah_diklat($id, $data)
    {
        $this->db->where('id_diklat', $id);
        $hsl = $this->db->update('karyawan_diklat', $data);
        return $hsl;
    }

    public function hapus_diklat($id)
    {
        $this->db->where('id_diklat', $id);
        $hsl = $this->db->delete('karyawan_diklat');
        return $hsl;
    }

    /* END DIKLAT */



    /*  SEMINAR */

    public function getDataSeminar($nip)
    {
        $this->datatables->select('*');
        $this->datatables->from('karyawan_seminar');
        $this->datatables->where('nip_karyawan', $nip);
        return $this->datatables->generate();
    }

    public function data_seminar($nip)
    {
        $this->db->where('nip_karyawan', $nip);
        $hsl = $this->db->get('karyawan_seminar');
        return $hsl;
    }

    public function detail_seminar($id)
    {
        $this->db->where('id_seminar', $id);
        $hsl = $this->db->get('karyawan_seminar');
        return $hsl;
    }

    public function simpan_seminar($data)
    {
        $hsl = $this->db->insert('karyawan_seminar', $data);
        return $hsl;
    }

    public function ubah_seminar($id, $data)
    {
        $this->db->where('id_seminar', $id);
        $hsl = $this->db->update('karyawan_seminar', $data);
        return $hsl;
    }

    public function hapus_seminar($id)
    {
        $this->db->where('id_seminar', $id);
        $hsl = $this->db->delete('karyawan_seminar');
        return $hsl;
    }

    /* END SEMINAR */

    public function rubah_tglformat($date)
    {
        $exp = explode('-', $date);
        if (count($exp) == 3) {
            $date = $exp[2] . '-' . $exp[1] . '-' . $exp[0];
        }
        return $date;
    }

    public function format_indo($date)
    {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        //result = $tgl . "-" . $BulanIndo[(int)$bulan-1]. "-". $tahun;
        $result = $tgl . "-" . $bulan . "-" . $tahun;
        return ($result);
    }

    public function tgl_indo($date)
    {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $result = $tgl . "-" . $BulanIndo[(int) $bulan - 1] . "-" . $tahun;
        //$result = $tgl."-".$bulan."-".$tahun;
        return ($result);
    }

    public function tampil_combo_karyawan($idlembaga, $idunitkerja)
    {
        $karyawan = null;
        $this->db->where('id_lembaga', $idlembaga);
        $this->db->where('id_unit_kerja', $idunitkerja);
        $this->db->order_by('nama_karyawan');
        $hsl = $this->db->get('karyawan');

        foreach ($hsl->result_array() as $data) {
            $karyawan .= "<option value='$data[id_karyawan]'>$data[nama_karyawan]</option>";
        }
        return $karyawan;
    }

    public function getHistoriAbsen($id)
    {
        $data = null;
        $this->db->select('a.*,b.ket_absen namaabsen,b.bc bc_masuk');
        $this->db->from("absen_karyawan a");
        $this->db->JOIN("status_absen b", "b.kd_absen=a.id_sts_hadir");
        $this->db->where('id_karyawan', $id);
        $hsl = $this->db->get();
       
        foreach ($hsl->result() as $row) {
            $data[] = array(
                'id' => $row->id_absen_karyawan,
                'backgroundColor' => $row->bc_masuk,
                'title' => $row->id_sts_hadir . " - JM " . $row->jam_masuk,
                'start' => $row->tgl_absen,
                'end' => $row->jam_keluar,
            );
        }
        return json_encode($data);

    }

     public function getPolaAbsen($idkaryawan)
    {
        $data = null;
        $this->db->select('a.*,b.kode_shift,b.nama_shift,bc');
        $this->db->from('absen_shift_karyawan a');
        $this->db->JOIN("absen_shift b", "b.id_shift=a.id_shift");
        $this->db->where_in('a.id_karyawan', $idkaryawan);
        $this->db->order_by('a.tgl_absen');

        $hsl = $this->db->get('');

       
        foreach ($hsl->result() as $row) {
            $data[] = array(
                'id' => $row->id_shift_karyawan,
                'backgroundColor' => $row->bc,
                'title' => $row->kode_shift,
                'start' => $row->tgl_absen,
            );
        }
        return json_encode($data);

    }

    public function DataKaryawanByDep($idlembaga, $idunitkerja)
    {
        $this->db->where('id_lembaga', $idlembaga);
        $this->db->where('id_unit_kerja', $idunitkerja);
        $this->db->order_by('nama_karyawan');
        $hsl = $this->db->get('karyawan');
        return $hsl->result();
    }

    public function reset_pin($id,$data){
		$this->db->where('id_karyawan',$id);
		$hsl=$this->db->update('karyawan',$data);
		return $hsl;

	}




   

   



}
