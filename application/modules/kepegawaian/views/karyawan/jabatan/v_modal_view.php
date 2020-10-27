<?php
foreach ($data->result() as $a) {
    $nipkaryawan = $a->nip_karyawan;
    $idkaryawan = $a->id_karyawan;
    $idjabkaryawan = $a->id_jabatan_karyawan;
    $idjabatan = $a->id_jabatan;
    $idunitkerja = $a->id_unitkerja;
    $tglsk = rubah_tanggal($a->tgl_sk);
    $nosk = $a->no_sk;
    $tmtjab = rubah_tanggal($a->tmt_jabatan);
    $urlsk = $a->url_sk;
}
?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
		<div class="callout callout-success" id="myModalLabel">
         <h4>DETAIL DATA JABATAN</h4>
        </div>
	</div>
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="formeditjabatan">
		<fieldset disabled>
		<input type="hidden" name="method" />
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">
			<input type="hidden" id="idjabkaryawan" name="idjabkaryawan" value="<?=$idjabkaryawan?>"class="form-control">
			<div class="form-group">
				<label class="col-md-4 control-label">Jabatan</label>
				<div class="col-md-7">
					<select class="form-control select2" name="idjabatan" id="idjabatan" style="width: 100%;" required>
					<?php
$no = 1;
foreach ($combojabatan as $row) {
    ?>
								<option value="<?php echo $row->id_jabatan; ?>" <?php if ($row->id_jabatan == $a->id_jabatan) {
        echo "selected=selected";}
    ?> ><?php echo $row->nama_jabatan; ?></option>
							<?php
$no++;}
?>
					</select>
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-4 control-label">Unit Kerja</label>
				<div class="col-md-7">
					<select class="form-control select2" name="idunitkerja" id="idunitkerja" style="width: 100%;" required>
					<?php
$no = 1;
foreach ($combounitkerja as $row) {
    ?>
								<option value="<?php echo $row->id_unit_kerja; ?>" <?php if ($row->id_unit_kerja == $a->id_unitkerja) {
        echo "selected=selected";}
    ?>><?php echo $row->nama_unit_kerja; ?></option>

							<?php
$no++;}
?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >No SK</label>
				<div class="col-sm-7">
					<input id="nosk" name="nosk" class="form-control" type="text" placeholder="Input No SK " value="<?=$nosk?>">
				<small class="help-block text-right"></small>
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-4 control-label">Tanggal SK</label>
				<div class="col-md-7">
					<div class="input-group date">
						<input type="text" name="tglsk" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicjabtgl" data-provide='datepicker' data-date-container='#modaljabatan' data-date-autoclose='true' value="<?=$tglsk?>">

						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
					<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">TMT Jabatan</label>
				<div class="col-md-7">
					<div class="input-group date">
						<input type="text" name="tmtjabatan" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicjabtgl2" data-provide='datepicker' data-date-container='#modaljabatan' data-date-autoclose='true' value="<?=$tmtjab?>">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
					<small class="help-block text-right"></small>
				</div>
			</div>




			<div class="form-group">
				<label class="col-md-4 control-label">File SK Jabatan</label>
				<div class="col-md-7">
				<?php if (isset($a->url_sk)) {
    ?>
									<img id="blah" name="urlawal" height="150px" width="150px" alt="" src="<?php echo base_url('storage/photo/karyawan/' . $a->url_sk); ?>"><br>
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

<script>
$('form#formeditjabatan').on('submit', function (e) {
	    ajaxcsrf();

        e.preventDefault();
		e.stopImmediatePropagation();


        var btn = $('#submit');
		btn.attr('disabled', 'disabled').text('Tunggu...');

        $.ajax({
            url: "<?=base_url('kepegawaian/jabatan/update')?>",
            type: 'POST',
			data: new FormData(this),
			processData:false,
			contentType:false,
			cache:false,
			async:false,
            success: function (data) {
                btn.removeAttr('disabled').text('Simpan');
                if (data.status) {
                    Swal({
                        "title": "Sukses",
                        "text": "Data Berhasil disimpan",
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            tablejabatan.ajax.reload(null, false);
						$("#modaljabatan").modal("hide");
  						e.stopPropagation();
                        }
                    });
                } else {
					 Swal({
						title: "Gagal" ,
						text: "Data gagal disimpan",
						type: "error"
						});
                    console.log(data.errors);
                    $.each(data.errors, function (key, value) {
                        $('[name="' + key + '"]').nextAll('.help-block').eq(2).text(value);
                        $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                        if (value == '') {
                            $('[name="' + key + '"]').nextAll('.help-block').eq(2).text('');
                            $('[name="' + key + '"]').closest('.form-group').removeClass('has-error').addClass('has-success');
                        }
                    });
				}

			},
				error: function () {
				Swal({
					title: "Gagal",
					text: "Kesalahan Sistem",
					type: "error"
				});
				}

        });
    });
</script>




