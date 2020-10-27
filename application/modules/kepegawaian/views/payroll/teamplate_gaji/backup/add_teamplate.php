
<section class="content-header">
	<h1>
		Tambah Teamplate
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
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
				<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/tambah_teamplate' ?>">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama Teamplate</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama_teamplate" id="inputEmail3" placeholder="Input Nama Teamplate">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Unit</label>
						<div class="col-sm-8">
							<select class="form-control select2" name="unit">
								<option disabled selected>Pilih Unit</option>
								<?php foreach ($dataunit as $key): ?>
									<option value="<?=$key->id_unit_kerja ; ?>"><?=$key->nama_unit_kerja; ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Yang Bertanda Tangan</label>
						<div class="col-sm-8">
							<select class="form-control select2" name="nip">
								<option disabled selected>Pilih Nik-Nama Karyawan</option>
								<?php foreach ($datakaryawan as $key): ?>
									<option value="<?=$key->nip_karyawan; ?>"><?=$key->nip_karyawan; ?>-<?=$key->nama_karyawan ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Scan Tanda Tangan</label>
						<div class="col-sm-8">
							<input type="file" class="form-control" id="inputEmail3" >
						</div>
					</div>
					
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Komponen Gaji</label>
						<div class="col-sm-8">
							<select class="form-control" name="Kategori[]">
								<option disabled selected>Pilih Kategori</option>
								<?php foreach ($datakategori as $key): ?>
									<option value="<?=$key->id_kategori; ?>"><?=$key->nama_kategori ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-sm-2">
							<a href="javascript:add();" id="add" class="btn btn-danger">Add</a>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label"></label>
						<div class="col-sm-3">
							<input name="komponen[]" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen...">
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="type[]">
								<option value="" disabled selected>Pilih Type</option>
								<option value="penambahan">Penambahan</option>
								<option value="pengurangan">Pengurangan</option>
								<option value="perusahaan">Perushaan</option>
							</select>
						</div>
						<div class="col-sm-2">
							<div class="col-sm-4">
							<a href="javascript:add_komponen();" class="btn btn-info">+</a>
							</div>
							<div class="col-sm-4">
							<a href="" class="btn btn-danger">x</a>
							</div>	
						</div>
					</div>
					

								<div id="record_komponen"></div>
								<div id="record"></div>
								<div id="record_komponen1"></div>
								<div id="record1"></div>
								<div id="record_komponen2"></div>
								<div id="record2"></div>
				</div>
				<input type="submit" name="" value="simpan">
			</div>
		</div>
	</div> 
	</form>
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
 	 $("#add").hide();
  var content = '';
  i++; 
  content += '<hr><a href="javascript:;" onclick="hapus(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label">Komponen Gaji</label><div class="col-sm-8"><select class="form-control" name="Kategori[]"><option disabled selected>Pilih Kategori</option><?php foreach ($datakategori as $key): ?><option value="<?=$key->id_kategori; ?>"><?=$key->nama_kategori ?></option><?php endforeach ?></select></div><div class="col-sm-2"><a id="add1" href="javascript:add1();" class="btn btn-danger">Add</a></div></div><div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label"></label><div class="col-sm-3"><input name="komponen[]" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..."></div><div class="col-sm-3"><select class="form-control" name="type[]"><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-2"><div class="col-sm-4"><a href="javascript:add_komponen'+i+'();" class="btn btn-info">+</a></div><div class="col-sm-4"><a href="" class="btn btn-danger">x</a></div></div></div>';
  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record').appendChild(x);
 }
 function add1() {
 $("#add1").hide();
  var content = '';
  i++; 
  content += '<hr><a href="javascript:;" onclick="hapus1(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label">Komponen Gaji</label><div class="col-sm-8"><select class="form-control" name="Kategori[]"><option disabled selected>Pilih Kategori</option><?php foreach ($datakategori as $key): ?><option value="<?=$key->id_kategori; ?>"><?=$key->nama_kategori ?></option><?php endforeach ?></select></div><div class="col-sm-2"><a id="add2" href="javascript:add2();" class="btn btn-danger">Add</a></div></div><div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label"></label><div class="col-sm-3"><input name="komponen[]" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..."></div><div class="col-sm-3"><select class="form-control" name="type[]"><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-2"><div class="col-sm-4"><a href="javascript:add_komponen'+i+'();" class="btn btn-info">+</a></div><div class="col-sm-4"><a href="" class="btn btn-danger">x</a></div></div></div>';
  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record1').appendChild(x);
 }
  function add2() {
 $("#add2").hide();
  var content = '';
  i++; 
  content += '<hr><a href="javascript:;" onclick="hapus2(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label">Komponen Gaji</label><div class="col-sm-8"><select class="form-control" name="Kategori[]"><option disabled selected>Pilih Kategori</option><?php foreach ($datakategori as $key): ?><option value="<?=$key->id_kategori; ?>"><?=$key->nama_kategori ?></option><?php endforeach ?></select></div><div class="col-sm-2"><a id="add3" href="javascript:add3();" class="btn btn-danger">Add</a></div></div><div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label"></label><div class="col-sm-3"><input name="komponen[]" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..."></div><div class="col-sm-3"><select class="form-control" name="type[]"><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-2"><div class="col-sm-4"><a href="javascript:add_komponen'+i+'();" class="btn btn-info">+</a></div><div class="col-sm-4"><a href="" class="btn btn-danger">x</a></div></div></div>';
  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record2').appendChild(x);
 }

   function add3() {
 $("#add3").hide();
  var content = '';
  i++; 
  content += '<hr><a href="javascript:;" onclick="hapus3(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label">Komponen Gaji</label><div class="col-sm-8"><select class="form-control" name="Kategori[]"><option disabled selected>Pilih Kategori</option><?php foreach ($datakategori as $key): ?><option value="<?=$key->id_kategori; ?>"><?=$key->nama_kategori ?></option><?php endforeach ?></select></div><div class="col-sm-2"><a id="add4" href="javascript:add4();" class="btn btn-danger">Add</a></div></div><div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label"></label><div class="col-sm-3"><input name="komponen[]" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..."></div><div class="col-sm-3"><select class="form-control" name="type[]"><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-2"><div class="col-sm-4"><a href="javascript:add_komponen'+i+'();" class="btn btn-info">+</a></div><div class="col-sm-4"><a href="" class="btn btn-danger">x</a></div></div></div>';
  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record3').appendChild(x);
 }

  function add4() {
 $("#add4").hide();
  var content = '';
  i++; 
  content += '<hr><a href="javascript:;" onclick="hapus4(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label">Komponen Gaji</label><div class="col-sm-8"><select class="form-control" name="Kategori[]"><option disabled selected>Pilih Kategori</option><?php foreach ($datakategori as $key): ?><option value="<?=$key->id_kategori; ?>"><?=$key->nama_kategori ?></option><?php endforeach ?></select></div><div class="col-sm-2"><a id="add5" href="javascript:add5();" class="btn btn-danger">Add</a></div></div><div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label"></label><div class="col-sm-3"><input name="komponen[]" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..."></div><div class="col-sm-3"><select class="form-control" name="type[]"><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-2"><div class="col-sm-4"><a href="javascript:add_komponen'+i+'();" class="btn btn-info">+</a></div><div class="col-sm-4"><a href="" class="btn btn-danger">x</a></div></div></div>';
  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record4').appendChild(x);
 }
 function add_komponen() {
  var content = '';
  // content += '<a href="javascript:;" onclick="hapus(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label"></label><div class="col-sm-3"><input type="text" class="form-control" name="komponen[]" id="inputEmail3" placeholder="input nama komponen..."></div><div class="col-sm-3"><select class="form-control" name="type[]"><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-2"><div class="col-sm-4"></div><div class="col-sm-4"><a href="" class="btn btn-danger">x</a></div></div></div>';

  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record_komponen').appendChild(x);
 }

  function add_komponen1() {
  var content = '';
  // content += '<a href="javascript:;" onclick="hapus(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label"></label><div class="col-sm-3"><input type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..."></div><div class="col-sm-3"><select class="form-control" name="type[]"><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-2"><div class="col-sm-4"></div><div class="col-sm-4"><a href="" class="btn btn-danger">x</a></div></div></div>';

  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record_komponen1').appendChild(x);
 }
   function add_komponen2() {
  var content = '';
  // content += '<a href="javascript:;" onclick="hapus(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label"></label><div class="col-sm-3"><input type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..."></div><div class="col-sm-3"><select class="form-control" name="type[]"><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-2"><div class="col-sm-4"></div><div class="col-sm-4"><a href="" class="btn btn-danger">x</a></div></div></div>';

  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record_komponen2').appendChild(x);
 }


 function hapus(element) {
 	 $("#add").show();
  var x = document.getElementById('record');
  x.removeChild(element.parentNode);
 
 }

 function hapus1(element) {
 	 $("#add1").show();
  var x = document.getElementById('record1');
  x.removeChild(element.parentNode);
 }
 function hapus2(element) {
 	 $("#add2").show();
  var x = document.getElementById('record2');
  x.removeChild(element.parentNode);
 }
 function hapus3(element) {
 	 $("#add3").show();
  var x = document.getElementById('record3');
  x.removeChild(element.parentNode);
 }
 function hapus4(element) {
 	 $("#add4").show();
  var x = document.getElementById('record4	');
  x.removeChild(element.parentNode);
 }
</script>
