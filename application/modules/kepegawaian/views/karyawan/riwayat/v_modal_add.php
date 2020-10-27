    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
		<div class="callout callout-success" id="myModalLabel">
         <h4>TAMBAH DATA RIWAYAT</h4>
        </div>
	</div>
	<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="formaddriwayat">
		<input type="hidden" name="method" value="add"/>
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="modal-body">
			<input type="hidden" id="nipkaryawan" name="nipkaryawan" value="<?=$nipkaryawan?>"class="form-control">
			<input type="hidden" id="idkaryawan" name="idkaryawan" value="<?=$idkaryawan?>"class="form-control">
			
			<div class="form-group">
				<label class="control-label col-sm-4" >Nama Perusahaan</label>
				<div class="col-sm-7">
					<input id="namaperusahaan" name="namaperusahaan" class="form-control" type="text" placeholder="Input Perusahaan">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Jabatan</label>
				<div class="col-sm-7">
					<input id="jabatan" name="jabatan" class="form-control" type="text" placeholder="Input Jabatan">
				<small class="help-block text-right"></small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Gaji</label>
				<div class="col-sm-7">
					<input id="gaji" name="gaji" class="form-control" type="number" placeholder="Input Gaji">
				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tahun Masuk</label>
				<div class="col-sm-7">
					<input id="tahunmasuk" name="tahunmasuk" class="form-control" maxlength="4" type="number" placeholder="Tahun Masuk">
				
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" >Tahun Keluar</label>
				<div class="col-sm-7">
					<input id="tahunkeluar" name="tahunkeluar" class="form-control" maxlength="4" type="number" placeholder="Tahun Keluar">
				
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
$('form#formaddriwayat').on('submit', function (e) {
	    ajaxcsrf();

        e.preventDefault();
		e.stopImmediatePropagation();

        var btn = $('#submit');
		btn.attr('disabled', 'disabled').text('Tunggu...');
		
        $.ajax({
            url: "<?=base_url('kepegawaian/riwayat/simpan')?>",
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
                            tableriwayat.ajax.reload(null, false);
						$("#modalriwayat").modal("hide");
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

