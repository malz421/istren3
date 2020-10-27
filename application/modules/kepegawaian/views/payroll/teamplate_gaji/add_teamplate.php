
<section class="content-header">
	<h1>
		Tambah Template
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
		<!--<?php echo $this->session->flashdata('msg'); ?>-->
		</div>
	</div>
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
		<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/tambah_teamplate' ?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
			<div class="box">
				<div class="box-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Template</label>
							<div class="col-md-6">
								<input type="text" name="nama_teamplate" class="form-control" placeholder="Input Nama Teamplate.." required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Lembaga</label>
							<div class="col-md-6">
								<select class="form-control select2" onchange="cekLemabaga()" name="lembaga" id="lembaga" required>
								<option disabled selected>Pilih Lembaga</option>
								<?php foreach ($datalembaga as $key): ?>
									<option value="<?=$key->id_lembaga ; ?>"><?=$key->nama_lembaga; ?></option>
								<?php endforeach ?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Unit</label>
							<div class="col-md-6">
								<select class="form-control select2"  onchange="cekUnit()" name="unit" id="unit" required>
								<option disabled selected>Pilih Unit</option>
								<?php foreach ($dataunit as $key): ?>
									<option value="<?=$key->id_unit_kerja ; ?>"><?=$key->nama_unit_kerja; ?></option>
								<?php endforeach ?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Yang Bertanda Tangan</label>
							<div class="col-md-6">
								<select class="form-control select2" name="nip" id="karyawan" required>
								<option disabled selected>Pilih Nik-Nama Karyawan</option>
								<?php foreach ($datakaryawan as $key): ?>
									<option value="<?=$key->nip_karyawan; ?>"><?=$key->nip_karyawan; ?>-<?=$key->nama_karyawan ?></option>
								<?php endforeach ?>
							</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Komponen Gaji</label>
							<div class="col-md-2">
								<a href="javascript:add();" id="add" class="btn btn-info"><i class="fa fa-arrow-down" aria-hidden="true"></i> Tambah Komponen Gaji</a>
							</div>

							<!-- <div class="col-md-2">
								<a href="#" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Komponen Kategori</a>
							</div> -->
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-2">
								<select class="form-control" name="Kategori[]" id="Kategori" required>
								<option disabled selected>Pilih Kategori</option>
								<?php foreach ($datakategori as $key): ?>
									<option value="<?=$key->id_group_kategori_komponen; ?>"><?=$key->nama_kategori ?></option>
								<?php endforeach ?>
							</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="komponen[]" id="komponen" required>
								<option disabled selected>Pilih Komponen</option>
								<?php foreach ($datakomponen as $key): ?>
									<option value="<?=$key->id_komponen_gaji ; ?>"><?=$key->nama_kategori_komponen ?></option>
								<?php endforeach ?>
							</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="type[]" required>
								<option value="" disabled selected>Pilih Type</option>
								<option value="Penambahan">Penambahan</option>
								<option value="Pengurangan">Pengurangan</option>
								<option value="Perusahaan">Perushaan</option>
							</select>
							</div>
						</div>
						
						<div id="record"></div>
						<div class="form-group">
							<label class="col-md-3 control-label">Photo Tanda Tangan</label>
							<div class="col-md-6">
								<img id="blah" name="photo" height="150px" width="150px" alt="" src="<?php echo base_url('assets/images/avatar.jpeg');?>"><br>
								<label style="width:150px;border-radius: 0px;margin-bottom:0px" class="btn btn-info btn-xs">Browse Foto
									<input enctype="multipart/form-data" type="file" style="width:150px;display:none;" id="image" name="userfile" accept=".jpg,.png,image/*" capture onchange="readURL()">
								</label><br>
								<span style="color:red;font-size:14px;text-align:center"><i>Limit size (100 KB)</i></span>
							<div>
					    </div>
							<div class="modal-footer">
									<a class="btn btn-danger" href="<?php echo base_url('kepegawaian/karyawan'); ?>" id="Keluar"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> Batal</a>
									<button type="submit" class="btn btn-info">Simpan</button>
							</div>
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
	var i=0; 
 function add() {
  var content = '';
 
  i++;
  // content += '<a href="javascript:;" onclick="hapus(this)" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a>';
  content += '<div class="form-group"><label class="col-md-3 control-label"></label><div class="col-md-2"><select class="form-control" name="Kategori[]" id="Kategori'+i+'" onchange="cekKategori('+i+')" required><option disabled selected>Pilih Kategori</option><?php foreach ($datakategori as $key): ?><option value="<?=$key->id_group_kategori_komponen; ?>"><?=$key->nama_kategori ?></option><?php endforeach ?></select></div><div class="col-md-2"><select class="form-control" name="komponen[]" id="komponen'+i+'" required><option disabled selected>Pilih Komponen</option><?php foreach ($datakomponen as $key): ?><option value="<?=$key->id_komponen_gaji ; ?>"><?=$key->nama_kategori_komponen ?></option><?php endforeach ?></select></div><div class="col-md-2"><select class="form-control" name="type[]" required><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-md-2"><a href="javascript:;" onclick="hapus(this)" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a></div></div>';
  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record').appendChild(x);
 }

</script>

