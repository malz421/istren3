    <?php
foreach ($datapendidikan->result() as $a) {
    $nipkaryawan = $a->nip_karyawan;
    $idkaryawan = $a->id_karyawan;
    $namasekolah = $a->nama_sekolah;
    $tahunmasuk = $a->tahun_masuk;
    $tahunlulus = $a->tahun_lulus;
	$ketsekolah = $a->keterangan_sekolah;
	$jurusan = $a->jurusan;

}
?>


	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
		<div class="callout callout-success" id="myModalLabel">
         <h4>DETAIL DATA PENDIDIKAN</h4>
        </div>
	</div>
	<form class="form-horizontal"  enctype="multipart/form-data" id="formdetailpendidikan">
		<fieldset disabled>
		<input type="hidden" name="method" value="add"/>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">
			<div class="form-group">
				<label class="col-md-4 control-label">Tingkat Pendidikan</label>
				<div class="col-md-7">
					<select class="form-control select2" name="idpendidikan" id="idpendidikan" style="width: 100%;" required>
					<?php
$no = 1;
foreach ($combopendidikan as $row) {
    ?>
													<option value="<?php echo $row->id_pendidikan; ?>" <?php if ($row->id_pendidikan == $a->id_pendidikan) {
        echo "selected=selected";
    }
    ?> ><?php echo $row->nama_pendidikan; ?></option>
												<?php
$no++;}
?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Jurusan</label>
				<div class="col-sm-7">
					<input id="namasekolah"  name="namasekolah" class="form-control" type="text" value="<?=$jurusan?>">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Nama Sekolah</label>
				<div class="col-sm-7">
					<input id="namasekolah"  name="namasekolah" class="form-control" type="text" placeholder="Input Nama Sekolah " value="<?=$namasekolah?>">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tahun Masuk</label>
				<div class="col-sm-7">
					<input id="thnmasuk" name="thnmasuk" class="form-control" type="text" placeholder="Input Tahun Lulus " value="<?=$tahunmasuk?>" >
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tahun Lulus</label>
				<div class="col-sm-7">
					<input id="thnlulus" name="thnlulus" class="form-control" type="text" placeholder="Input Tahun Lulus " value="<?=$tahunlulus?>" >
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Keterangan</label>
				<div class="col-sm-7">
					<input id="ketsekolah"  name="ketsekolah" class="form-control" type="text" placeholder="Input Keterangan " value="<?=$ketsekolah?>">
				<small class="help-block text-right"></small>
				</div>
			</div>
		</div>
		</fieldset>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
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


