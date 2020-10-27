<?php
foreach ($data->result() as $a) {
    $nipkaryawan = $a->nip_karyawan;
	$idkaryawan = $a->id_karyawan;
	$idkerja  = $a->id_kerja;
	$namaperusahaan = $a->nama_perusahaan;
	$jabatan = $a->jabatan;
	$gaji = $a->gaji;
	$tahunmasuk = $a->tahun_awal;
	$tahunkeluar = $a->tahun_akhir;
}
?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
		<div class="callout callout-success" id="myModalLabel">
         <h4>DETAIL DATA RIWAYAT</h4>
        </div>
	</div>
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="formeditriwayat">
		<fieldset disabled>
		<input type="hidden" name="method" value="edit"/>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">
			<input type="hidden" id="idriwayat" name="idriwayat" value="<?=$idkerja?>"class="form-control">
			
			<div class="form-group">
				<label class="control-label col-sm-4" >Nama Perusahaan</label>
				<div class="col-sm-7">
					<input id="namaperusahaan" name="namaperusahaan" class="form-control" type="text" placeholder="Input Perusahaan" value="<?= $namaperusahaan ?>"  >
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Jabatan</label>
				<div class="col-sm-7">
					<input id="jabatan" name="jabatan" class="form-control" type="text" placeholder="Input Jabatan" value="<?= $jabatan ?>">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Gaji</label>
				<div class="col-sm-7">
					<input id="gaji" name="gaji" class="form-control" type="number" placeholder="Input Gaji" value="<?= $gaji ?>">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tahun Masuk</label>
				<div class="col-sm-7">
					<input id="tahunmasuk" name="tahunmasuk" class="form-control" maxlength="4" type="number" placeholder="Tahun Masuk" value="<?= $tahunmasuk ?>">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tahun Keluar</label>
				<div class="col-sm-7">
					<input id="tahunkeluar" name="tahunkeluar" class="form-control" maxlength="4" type="number" placeholder="Tahun Keluar" value="<?= $tahunkeluar ?>"> 
				<small class="help-block text-right"></small>
				</div>
			</div>

		</div>
		</fieldset>
		<div class="modal-footer">
			
			<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
		</div>
	</form>

<?php
function rubah_tanggal($date)
{
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $result = $tgl . "-" . $bulan . "-" . $tahun;
    return ($result);
}
?>

<script>
	$(function () {
		$("select2").select2("readonly", true);
  });
</script>







	
