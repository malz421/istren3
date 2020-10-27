    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
		<div class="callout callout-success" id="myModalLabel">
         <h4>TAMBAH DATA SEMINAR / TRAINING</h4>
        </div>
	</div>
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="formaddseminar">
		<input type="hidden" name="method" value="add"/>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">
			<div class="form-group">
				
			<div class="form-group">
				<label class="control-label col-sm-4" >Nama Seminar / Training</label>
				<div class="col-sm-8">
					<input id="namaseminar" name="namaseminar" class="form-control" type="text" placeholder="Input Nama Seminar ">
				<small class="help-block text-right"></small>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" >Nama Penyelenggara </label>
				<div class="col-sm-8">
					<input id="penyelenggaraseminar" name="penyelenggaraseminar" class="form-control" type="text" placeholder="Input Penyelenggara ">
				<small class="help-block text-right"></small>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" >Tempat Seminar / Training</label>
				<div class="col-sm-8">
					<input id="tempatseminar" name="tempatseminar" class="form-control" type="text" placeholder="Input Tempat Seminar ">
				<small class="help-block text-right"></small>
				</div>
			</div>

			
			<div class="form-group">
				<label class="col-md-4 control-label">Tanggal Seminar</label>
				<div class="col-md-4">
					<div class="input-group date">
						<input type="text" name="tglawalseminar" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicseminar1" data-provide='datepicker' data-date-container='#modalseminar' data-date-autoclose='true' placeholder="Mulai">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
					<small class="help-block text-right"></small>
				</div>
				<div class="col-md-4 ">
					<div class="input-group date">
						<input type="text" name="tglakhirseminar" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicseminar2" data-provide='datepicker' data-date-container='#modalseminar' data-date-autoclose='true' placeholder="Akhir">
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
                              <?php if (isset($a->photo_profile)) {
                                  ?>
                                                    <img id="blah" name="urlawal" height="150px" width="150px" alt="" src="<?php echo base_url('storage/photo/karyawan/' . $a->photo_profile); ?>"><br>
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
$('form#formaddseminar').on('submit', function (e) {
	    ajaxcsrf();

        e.preventDefault();
		e.stopImmediatePropagation();
	

        var btn = $('#submit');
		btn.attr('disabled', 'disabled').text('Tunggu...');
		
        $.ajax({
            url: "<?=base_url('kepegawaian/seminar/simpan')?>",
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
                            tableseminar.ajax.reload(null, false);
						$("#modalseminar").modal("hide");
  						e.stopPropagation();
                        }
                    });
                } else {
					 Swal({
						title: "Gagal",
						text: "Data gagal disimpan",
						type: "error"
						});
                    console.log(data.errors);
                    $.each(data.errors, function (key, value) {
                        $('[name="' + key + '"]').nextAll('.help-block').text(value);
                        $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                        if (value == '') {
                            $('[name="' + key + '"]').nextAll('.help-block').text('');
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

