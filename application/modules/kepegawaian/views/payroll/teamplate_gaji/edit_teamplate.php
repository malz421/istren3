<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<section class="content-header">
	<h1>
		Edit Template
	</h1>
</section>

<!-- Main content -->
<section class="content">

<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
					<a href="<?php echo base_url('kepegawaian/karyawan'); ?>"  class="btn btn-sm btn-danger" >
					<span class="fa fa-mail-forward"></span> Kembali</a>
				</div>
			</div>
		</div>
	</div> 
	<!-- /.row -->
	<!-- Content -->
	<div class="row">
		<div class="col-lg-12">
		<form class="form-horizontal" enctype="multipart/form-data" id="formInput">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
			<div class="box">
				<div class="box-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Teamplate</label>
							<div class="col-md-6">
								<input type="hidden" value="<?=$id;?>" name="id_teamplate" class="form-control">
								<input type="text" value="<?=$datakomponen->nama_teamplate ?>" name="nama_teamplate" class="form-control" placeholder="Input Nama Teamplate.." required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Lembaga</label>
							<div class="col-md-6">
								<select class="form-control select2" name="lembaga" id="lembaga">
									<option value="<?=$datakomponen->id_lembaga; ?>" selected><?=$datakomponen->nama_lembaga; ?></option>
									<?php foreach ($datalembaga as $key): ?>
										<option value="<?=$key->id_lembaga; ?>"><?=$key->nama_lembaga ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Unit</label>
							<div class="col-md-6">
								<select class="form-control select2" name="unit" id="unit" required>
									<option value="<?=$datakomponen->id_unit_kerja ?>" selected><?=$datakomponen->nama_unit_kerja; ?></option>
									<?php foreach ($dataunit as $key): ?>
										<option value="<?=$key->id_unit_kerja; ?>"><?=$key->nama_unit_kerja ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Yang Bertanda Tangan</label>
							<div class="col-md-6">
								<select class="form-control select2" name="nip" id="karyawan" required>
									<option value="<?=$datakomponen->nip_karyawan; ?>"><?=$datakomponen->nip_karyawan; ?> - <?=$datakomponen->nama_karyawan; ?></option>
									<?php foreach ($datakaryawan as $key): ?>
										<option value="<?=$key->nip_karyawan; ?>"><?=$key->nip_karyawan; ?> - <?=$key->nama_karyawan ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-md-2">
								<a href="javascript:add();" id="add" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Komponen</a>
							</div>
						</div>

						<!-- JIKA TIDAK ADA KOMPONEN -->
						<?php $no2=1; ?>
					<?php if (empty($komponen_gaji->row())): ?>
						<?php $id=$no2++; ?>	
						<div class="form-group">
							<label class="col-md-3 control-label">Komponen Gaji</label>
							<div class="col-md-2">
								<select class="form-control" name="Kategori[]" onchange="Kategori('<?=$id; ?>')" id="Kategori<?=$id; ?>" required>
								<option disabled selected>Pilih Kategori</option>
								<?php foreach ($datakategori as $key): ?>
									<option value="<?=$key->id_group_kategori_komponen; ?>"><?=$key->nama_kategori ?></option>
								<?php endforeach ?>
							</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="komponen[]" id="komponen<?=$id; ?>">
									<option selected>Pilih Komponen</option>
									<?php foreach ($datakomponen2 as $key2): ?>
									<option value="<?=$key2->id_komponen_gaji; ?>"><?=$key2->nama_kategori_komponen ?></option>
								<?php endforeach ?>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="type[]" id="type<?=$id; ?>" required>
								<option value="" disabled selected>Pilih Type</option>
								<option value="penambahan">Penambahan</option>
								<option value="pengurangan">Pengurangan</option>
								<option value="perusahaan">Perushaan</option>
							</select>
							</div>
							<!-- <div class="col-md-2">
								<a href="javascript:add();" id="add" class="btn btn-info">Add</a>
							</div> -->
						</div>
					<?php endif ?>
					<!-- JIKA ADA KOMPONEN -->
						<?php $no=1; ?>
					<?php foreach ($komponen_gaji->result() as $key): ?>	
					<?php $id=$no++; ?>	
						<div class="form-group" id="sayurkol">
							<label class="col-md-3 control-label">Komponen Gaji</label>
							<div class="col-md-2">
								<select class="form-control" name="Kategori[]" onchange="Kategori('<?=$id; ?>')" id="Kategori<?=$id; ?>" required>
									<option value="<?=$key->id_group_kategori_komponen; ?>" selected><?=$key->nama_kategori; ?></option>
									<?php foreach ($datakategori as $key2): ?>
									<option value="<?=$key2->id_group_kategori_komponen; ?>"><?=$key2->nama_kategori ?></option>
								<?php endforeach ?>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="komponen[]" id="komponen<?=$id; ?>">
									<option value="<?=$key->id_komponen_gaji;?>"><?=$key->nama_kategori_komponen; ?></option>
									<?php foreach ($datakomponen2 as $key2): ?>
									<option value="<?=$key2->id_komponen_gaji; ?>"><?=$key2->nama_kategori_komponen ?></option>
								<?php endforeach ?>
								</select>

								<!-- <input name="komponen[]" value="<?=$key->nama_kategori_komponen; ?>" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..." required> -->
							</div>
							<div class="col-md-2">
								<select class="form-control" name="type[]" id="type<?=$id; ?>" required>
									<option><?=$key->type; ?></option>
									<option value="Penambahan">Penambahan</option>
									<option value="Pengurangan">Pengurangan</option>
									<option value="Perusahaan">Perushaan</option>
								</select>
							</div>
							<div class="col-md-2">
								<a class="btn btn-danger tombol-hapus" href="<?php echo base_url().'kepegawaian/payroll/hapus_komponen/'.$key->id_detail_template.'/'.$key->id_teamplate;?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
							</div>
						</div>
						<?php endforeach ?>
						
						<div id="record"></div>


						<div class="form-group">
						
							<div class="modal-footer">
									<a class="btn btn-danger" href="<?php echo base_url('kepegawaian/karyawan'); ?>" id="Keluar"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> Batal</a>
									<button type="submit" class="btn btn-info">Simpan</button>
							</div>
						</div>


			</form>
		</div>
	</div>
</section>
<!--load select2-->
<script>
  $(function () {
    $(".select2").select2();
  });
</script>
<script type="text/javascript">
	$('#formInput').submit(function(e){
		 //  ajaxcsrf();
			// e.preventDefault();
			// Swal({
			// 	title: 'Anda Yakin?',
			// 	text: 'Setelah anda ubah ini data jumlah gaji yang belum dipost akan di Reset!',
			// 	type: 'warning',
			// 	showCancelButton: true,
			// 	confirmButtonColor: '#3085d6',
			// 	cancelButtonColor: '#d33',
			// 	confirmButtonText: 'Ya, Saya Mau Merubahnya!'
			// }).then((result) => {
			// 	if (result.value) {
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url('kepegawaian/payroll/update_teamplate') ?>',
						 data: $('#formInput').serialize(),
						 dataType: 'json',
						 beforeSend: function(e) {
						 	if(e && e.overrideMimeType) {
						 		e.overrideMimeType('application/jsoncharset=UTF-8')
						 	}
						 },
						success: function(data){
							console.log(data.status);
							if(data.status == 'sukses'){
								console.log('oke');
								   swal({
                                    title:"Data Berhasil Diubah",
                                    text: "Terimakasih",
                                    type: "success"
                                  }).then((result) =>{
                                  	window.history.go(-2)
                                  });
							}
							else
							{
								console.log('no');
							}
						},error: function(){
						    alert('error!');
						  }
					});
	// 			}
	// 		});
   });
    </script>

<script type="text/javascript">
	var i='<?=$jml; ?>'; 
 function add() {
  var content = '';
  i++;
  // content += '<a href="javascript:;" onclick="hapus(this)">Hapus record</a><br />';
  content += '<div class="form-group"><label class="col-md-3 control-label"></label><div class="col-md-2"><select class="form-control" id="Kategori'+i+'" name="Kategori[]" onchange="cekKategori('+i+')" required><option disabled selected>Pilih Kategori</option><?php foreach ($datakategori as $key): ?><option value="<?=$key->id_group_kategori_komponen; ?>"><?=$key->nama_kategori ?></option><?php endforeach ?></select></div><div class="col-md-2"><select class="form-control" name="komponen[]" id="komponen'+i+'" required><option disabled selected>Pilih Komponen</option><?php foreach ($datakomponen2 as $key): ?><option value="<?=$key->id_komponen_gaji ; ?>"><?=$key->nama_kategori_komponen ?></option><?php endforeach ?></select></div><div class="col-md-2"><select class="form-control" name="type[]" required><option value="" disabled selected>Pilih Type</option><option value="Penambahan">Penambahan</option><option value="Pengurangan">Pengurangan</option><option value="Perusahaan">Perushaan</option></select></div><div class="col-md-2"><a href="javascript:;" onclick="hapus(this)" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a></div></div>';
  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record').appendChild(x);
 }


  function Kategori(id){
      ajaxcsrf();
    var Kategori = $('#Kategori'+id).val();
    console.log(Kategori);
      $.ajax({
          type: 'POST',
        url: '<?php echo base_url('kepegawaian/payroll/tampil_combo_komponen') ?>',
          data: { 'Kategori' : Kategori},
        success: function(data){
        if(data.length > 0){
          $("#komponen"+id).html(data);
         }
         else
         {
        $('#komponen'+id).html("<option disabled selected>Pilih komponen</option>");
         }
        }
      });
  }

</script>

