<?php
foreach ($data->result() as $a) {
	$nipkaryawan = $a->nip_karyawan;
	$idkaryawan = $a->id_karyawan;
	$idseminar  = $a->id_seminar;
	$tempatseminar = $a->tempat_seminar;
	$namaseminar = $a->nama_seminar;
	$penyelenggara = $a->penyelenggara;
	$tglawal = rubah_tanggal($a->tgl_awal_seminar);
	$tglakhir =  rubah_tanggal($a->tgl_akhir_seminar);
	$urlsk = $a->url_sertifikat;
}
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
	<div class="callout callout-success" id="myModalLabel">
		<h4>UBAH DATA SEMINAR</h4>
	</div>
</div>
<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="formeditseminar">
	<fieldset disabled>
		<input type="hidden" name="method" value="edit"/>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">

			<div class="form-group">
				
				<div class="form-group">
					<label class="control-label col-sm-4" >Nama Seminar / Training</label>
					<div class="col-sm-8">
						<input id="namaseminar" name="namaseminar" class="form-control" type="text" placeholder="Input Nama Seminar " value ="<?= $namaseminar ?>" >
						<small class="help-block text-right"></small>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" >Nama Penyelenggara </label>
					<div class="col-sm-8">
						<input id="penyelenggaraseminar" name="penyelenggaraseminar" class="form-control" type="text" placeholder="Input Penyelenggara" value ="<?= $penyelenggara ?>">
						<small class="help-block text-right"></small>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" >Tempat Seminar / Training</label>
					<div class="col-sm-8">
						<input id="tempatseminar" name="tempatseminar" class="form-control" type="text" placeholder="Input Tempat Seminar " value ="<?= $tempatseminar ?>">
						<small class="help-block text-right"></small>
					</div>
				</div>

				
				<div class="form-group">
					<label class="col-md-4 control-label">Tanggal Seminar</label>
					<div class="col-md-4">
						<div class="input-group date">
							<input type="text" name="tglawalseminar" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicseminar1" data-provide='datepicker' data-date-container='#modalseminar' data-date-autoclose='true' placeholder="Mulai" value ="<?= $tglawal ?>">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
						</div>
						<small class="help-block text-right"></small>
					</div>
					<div class="col-md-4 ">
						<div class="input-group date">
							<input type="text" name="tglakhirseminar" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicseminar2" data-provide='datepicker' data-date-container='#modalseminar' data-date-autoclose='true' placeholder="Akhir" value ="<?= $tglakhir ?>"  >
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
						</div>
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

						<label style="width:150px;border-radius: 0px;margin-bottom:0px" class="btn btn-info btn-xs">Browse File
							<input enctype="multipart/form-data" type="file" style="width:150px;display:none;" id="urlpic" name="urlpic" accept=".jpg,.png,image/*" >
						</label><br>
						<span style="color:red;font-size:14px;text-align:center"><i>Limit size (100 KB)</i></span>
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

