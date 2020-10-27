
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
		<div class="callout callout-success" id="myModalLabel">
         <h4>TAMBAH DATA KELUARGA</h4>
        </div>
	</div>
	<form class="form-horizontal" enctype="multipart/form-data" id="formaddkeluarga">
		<input type="hidden" name="method" value="add"/>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">
			<div class="form-group">
					<label class="control-label col-sm-4" >NIK</label>
					<div class="col-sm-7">
						<input id="nikkel" name="nikkel" class="form-control" type="text" placeholder="Input NIK ">
					 	<small class="help-block text-right"></small>
					</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Nama</label>
				<div class="col-sm-7">
					<input id="namakel"  name="namakel" class="form-control" type="text" placeholder="Input Nama ">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">Hubungan</label>
				<div class="col-md-7">
					<select class="form-control select2" name="hubkel" id="hubkel" style="width: 100%;" required>
					<?php
						$no = 1;
						foreach ($combohubungan as $row) {
						?>
						<option value="<?php echo $row->id_hubungan; ?>"><?php echo $row->nama_hubungan; ?></option>
						<?php
						$no++;}
						?>
					</select>
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-4 control-label">Tanggal lahir</label>
				<div class="col-md-7">
					<div class="input-group date">
						<input type="text" name="tgllhrkel" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepickeluarga"data-provide='datepicker' data-date-container='#modalkeluarga' data-date-autoclose='true' >
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
					<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">Jenis Kelamin</label>
				<div class="col-md-7">
					<select  id="jkkel" name="jkkel" class="default-select2 form-control">
						<option value="l" selected>Laki-laki
						<option value="p" >Perempuan
					</select>
					<small class="help-block text-right"></small>
				</div>
			</div>


            <div class="form-group">
							<label class="control-label col-md-4">Pendidikan</label>
							<div class="col-md-7">
								<select class="form-control select2"  name="penkel" id="penkel" style="width: 100%;" required>
								<?php
										$no = 1;
										foreach ($combopendidikan as $row) {
										?>
											<option value="<?php echo $row->id_pendidikan; ?>"><?php echo $row->nama_pendidikan; ?></option>
										<?php
										$no++;}
										?>
								</select>
								<small class="help-block text-right"></small>
							</div>
			</div>

          	<div class="form-group">
				<label class="control-label col-md-4">Pekerjaan</label>
				<div class="col-md-7">
					<select class="form-control select2" name="kerjakel" id="kerjakel" style="width: 100%;" required>
					<?php
						$no = 1;
						foreach ($combopekerjaan as $row) {
							?>
						<option value="<?php echo $row->id_kerja; ?>"><?php echo $row->nama_pekerjaan; ?></option>
						<?php
						$no++;}
						?>
					</select>
					<small class="help-block text-right"></small>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
			<button id="submit" type="submit" class="btn btn-info">Simpan</button>
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
		$(".select2").select2();
	});
	
</script>

<script>
$('form#formaddkeluarga').on('submit', function (e) {
	    ajaxcsrf();
        e.preventDefault();
        e.stopImmediatePropagation();

        var btn = $('#submit');
        btn.attr('disabled', 'disabled').text('Tunggu...');

        $.ajax({
            url: "<?=base_url('kepegawaian/karyawan/simpan_keluarga')?>",
            data: $(this).serialize(),
            type: 'POST',
            success: function (data) {
                btn.removeAttr('disabled').text('Simpan');
                if (data.status) {
                    Swal({
                        "title": "Sukses",
                        "text": "Data Berhasil disimpan",
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            tablekeluarga.ajax.reload(null, false);
						$("#modalkeluarga").modal("hide");
  						e.stopPropagation();
                        }
                    });
                } else {
                    console.log(data.errors);
                    $.each(data.errors, function (key, value) {
                        $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(value);
                        $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                        if (value == '') {
                            $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
                            $('[name="' + key + '"]').closest('.form-group').removeClass('has-error').addClass('has-success');
                        }
                    });
                }
            }
        });
    });
</script>

