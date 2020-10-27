    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
		<div class="callout callout-success" id="myModalLabel">
         <h4>TAMBAH DATA DIKLAT</h4>
        </div>
	</div>
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="formadddiklat">
		<input type="hidden" name="method" value="add"/>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">

			<div class="form-group">
				<label class="control-label col-sm-4" >Nama Diklat</label>
				<div class="col-sm-7">
					<input id="namadiklat" name="namadiklat" class="form-control" type="text" placeholder="Input Nama Diklat ">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Penyelenggara Diklat</label>
				<div class="col-sm-7">
					<input id="penyelenggaradiklat" name="penyelenggaradiklat" class="form-control" type="text" placeholder="Input Penyelenggara Diklat ">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tempat Diklat</label>
				<div class="col-sm-7">
					<input id="tempatdiklat" name="tempatdiklat" class="form-control" type="text" placeholder="Input Tempat Diklat ">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tahun Diklat</label>
				<div class="col-sm-7">
					<input id="tahundiklat" name="tahundiklat" class="form-control" type="number" placeholder="Input Tahun DIklat ">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">File Sertifikat</label>
				<div class="col-md-7">
							
				<img id="blah" name="urlawal" height="150px" width="150px" alt="" src="<?php echo base_url('assets/images/no-file.png'); ?>"><br>
	
			
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
$('form#formadddiklat').on('submit', function (e) {
	    ajaxcsrf();

        e.preventDefault();
		e.stopImmediatePropagation();
	

        var btn = $('#submit');
		btn.attr('disabled', 'disabled').text('Tunggu...');
		
        $.ajax({
            url: "<?=base_url('kepegawaian/diklat/simpan')?>",
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
                            tablediklat.ajax.reload(null, false);
						$("#modaldiklat").modal("hide");
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

