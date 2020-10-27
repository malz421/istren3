<?php
foreach ($data->result() as $a) {
    $nipkaryawan = $a->nip_karyawan;
    $idkaryawan = $a->id_karyawan;
    $iddiklat = $a->id_diklat;
    $namadiklat = $a->nama_diklat;
    $penyelenggaradiklat = $a->penyelenggara_diklat;
    $tempatdiklat = $a->tempat_diklat;
    $tahundiklat = $a->tahun_diklat;
    $url = $a->url_sertifikat;
}
?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
		<div class="callout callout-success" id="myModalLabel">
         <h4>DETAIL DATA DIKLAT</h4>
        </div>
	</div>
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="formeditdiklat">
		<fieldset disabled>
		<input type="hidden" name="method" value="edit"/>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">
			<input type="hidden" id="iddiklat" name="iddiklat" value="<?=$iddiklat?>"class="form-control">
			<div class="form-group">
				<label class="control-label col-sm-4" >Nama Diklat</label>
				<div class="col-sm-7">
					<input id="namadiklat" name="namadiklat" class="form-control" type="text" placeholder="Input Nama Diklat " value="<?=$namadiklat?>" >
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Penyelenggara Diklat</label>
				<div class="col-sm-7">
					<input id="penyelenggaradiklat" name="penyelenggaradiklat" class="form-control" type="text" placeholder="Input Penyelenggara Diklat " value="<?=$penyelenggaradiklat?>">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tempat Diklat</label>
				<div class="col-sm-7">
					<input id="tempatdiklat" name="tempatdiklat" class="form-control" type="text" placeholder="Input Tempat Diklat" value="<?=$tempatdiklat?>"" >
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tahun Diklat</label>
				<div class="col-sm-7">
					<input id="tahundiklat" name="tahundiklat" class="form-control" type="number" placeholder="Input Tahun Diklat " value = "<?=$tahundiklat?>">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">File Sertifikat</label>
				<div class="col-md-7">
				<?php if (isset($a->url_sertifikat)) {
    ?>
									<img id="blah" name="urlawal" height="150px" width="150px" alt="" src="<?php echo base_url('storage/photo/karyawan/' . $a->url_sertifikat); ?>"><br>
									<?php
} else {
    ?>
																		<img id="blah" name="urlawal" height="150px" width="150px" alt="" src="<?php echo base_url('assets/images/no-file.png'); ?>"><br>
																		<?php
}
?>


				
				</div>
			</div>

		</fieldset>
		</div>
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

