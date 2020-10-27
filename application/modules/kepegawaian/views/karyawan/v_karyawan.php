
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Data Karyawan
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
			<div class="box box-primary">
				<div class="box-body">
					<div class="pull-right">
						<a href="<?php echo base_url('kepegawaian/karyawan/tambah_karyawan'); ?>" class="btn btn-sm btn-success">
						<span class="fa fa-plus"></span> Tambah Karyawan</a>
						<a href="<?php echo base_url('kepegawaian/karyawan'); ?>" class="btn btn-sm btn-info">
						<span class="fa fa-refresh"></span> Refresh</a>
						<a href="<?php echo base_url('all/admin_page'); ?>"  class="btn btn-sm btn-danger" >
						<span class="fa fa-mail-forward"></span> Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="form-group">
							<label class="control-label col-sm-2">Lembaga</label>
							<div class="col-sm-3">
								<select <?php if ($this->session->userdata('akseslembaga') == "T") {?>disabled="disabled"<?php }?> class="form-control select2" name="idlembaga" id="idlembaga_combo" style="width: 100%;">
									<?php
$no = 1;
foreach ($combolembaga as $row) {
    ?>
										<option value="<?php echo $row->id_lembaga; ?>"><?php echo $row->nama_lembaga; ?></option>
									<?php
$no++;}
?>
									<?php if ($this->session->userdata('akseslembaga') == "Y") {?>
											<option value="all">SEMUA LEMBAGA</option>
									<?php }?>
								</select>

							</div>
					</div>
				</div>
				<!--<div class="box-footer">
				<button type="submit" class="btn btn-primary">Cari</button>
				</div>-->
			</div>
		</div>
	</div>


	<!-- /.row -->
	<!-- Content -->
	<div class="row">
		<div class= "table-responsive" style="border: 0">
			<div class="box">
				<div class="box-body">
					<table class="table table-bordered table-striped" style="font-size:14px;" id="karyawan">
						<thead>
						<tr>
						   <th class="text-center">
							<input type="checkbox" class="select_all">
							</th>
							<th>No</th>
							<th>Photo</th>
						    <th>NIP Karyawan</th>
							<th>NIK Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Lembaga</th>
							<th>Unit Kerja</th>
							<th>Jenis Kelamin</th>
							<th>Aksi</th>
						</tr>
						</thead>

					</table>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- MODAL HAPUS -->

<!-- ============ MODAL HAPUS =============== -->
<?php
foreach ($datakaryawan->result_array() as $a) {
    $id = $a['id_karyawan'];
    ?>
<div id="modalHapus<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Karyawan</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/karyawan/hapus_karyawan' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				<p>Yakin mau menghapus data..?</p>
				<input name="kode" type="hidden" value="<?php echo $id; ?>">
				</div>
				<div class="modal-footer">
				<button class="btn btn-default pull-left" data-dismiss="modal" aria-hidden="true">Batal</button>
				<button type="submit" class="btn btn-primary pull-left">Hapus</button>
				</div>
			</form>
			</div>
	</div>
</div>
<?php
}
?>
<!--END MODAL-->


<script type="text/javascript">
$(document).ready(function(){
	$('#idlembaga_combo').on('change', function(){
		let id_lembaga = $(this).val();
		let src = '<?=base_url()?>kepegawaian/karyawan/data';
		let url;

	   if(id_lembaga !== 'all'){
			let src2 = src + '/' + id_lembaga;
			url = $(this).prop('checked') === true ? src : src2;
		}else{
			url = src;
		}
		table.ajax.url(url).load();
	});
});
</script>









