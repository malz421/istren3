
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
				<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/tambah_teamplate' ?>" enctype="multipart/form-data">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nama Teamplate</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama_teamplate" id="inputEmail3" placeholder="Input Nama Teamplate" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Unit</label>
						<div class="col-sm-8">
							<select class="form-control select2" name="unit" required>
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
							<select class="form-control select2" name="nip" required>
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
							<input type="file" name="userfile" class="form-control" id="inputEmail3" required>
						</div>
					</div>
					
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Komponen Gaji</label>
						<div class="col-sm-3">
							<select class="form-control" name="Kategori[]" required>
								<option disabled selected>Pilih Kategori</option>
								<?php foreach ($datakategori as $key): ?>
									<option value="<?=$key->id_kategori; ?>"><?=$key->nama_kategori ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-sm-3">
							<input name="komponen[]" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..." required>
						</div>
						<div class="col-sm-2">
							<select class="form-control" name="type[]" required>
								<option value="" disabled selected>Pilih Type</option>
								<option value="penambahan">Penambahan</option>
								<option value="pengurangan">Pengurangan</option>
								<option value="perusahaan">Perushaan</option>
							</select>
						</div>
						<div class="col-sm-1">
							<a href="javascript:add();" id="add" class="btn btn-danger">Add</a>
						</div>
					</div>
					<div id="record"></div>
					<div class="modal-footer" style="margin-right: 200px; margin-top:50px;">
								<a class="btn btn-danger" href="<?=base_url('kepegawaian/Payroll/teamplate_gaji'); ?>"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> Batal</a>
								<button type="submit" class="btn btn-info">Simpan</button>
						</div>
				</div>

				
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
 	 // $("#add").hide();
  var content = '';
  content += '<hr><a href="javascript:;" onclick="hapus(this)">Hapus record</a><br />';
  content += '<div class="form-group row"><label for="inputEmail3" class="col-sm-2 col-form-label">Komponen Gaji</label><div class="col-sm-3"><select class="form-control" name="Kategori[]" required><option disabled selected>Pilih Kategori</option><?php foreach ($datakategori as $key): ?><option value="<?=$key->id_kategori; ?>"><?=$key->nama_kategori ?></option><?php endforeach ?></select></div><div class="col-sm-3"><input name="komponen[]" type="text" class="form-control" id="inputEmail3" placeholder="input nama komponen..." required></div><div class="col-sm-2"><select class="form-control" name="type[]" required><option value="" disabled selected>Pilih Type</option><option value="penambahan">Penambahan</option><option value="pengurangan">Pengurangan</option><option value="perusahaan">Perushaan</option></select></div><div class="col-sm-1"><a href="javascript:add();" id="add" class="btn btn-danger">Add</a></div></div>';
  var x = document.createElement('div');
  x.innerHTML = content;
  document.getElementById('record').appendChild(x);
 }


 function hapus(element) {
 	 $("#add").show();
  var x = document.getElementById('record');
  x.removeChild(element.parentNode);
 
 }

</script>
