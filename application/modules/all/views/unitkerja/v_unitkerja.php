
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Unit Kerja
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
					<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal">
					<span class="fa fa-plus"></span> Tambah Unit Kerja</a>
					<a href="<?php echo base_url('all/unitkerja'); ?>" class="btn btn-sm btn-info">
					<span class="fa fa-refresh"></span> Refresh</a>
					<a href="<?php echo base_url('all/admin_page'); ?>"  class="btn btn-sm btn-danger" >
					<span class="fa fa-mail-forward"></span> Kembali</a>
				</div>
			</div>
		</div>
	</div> 
	<!-- /.row -->
	<!-- Content -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
					<table class="table table-bordered table-striped" style="font-size:14px;" id="example2">
						<thead>
						<tr>
						   <th>Nama Unit Kerja</th>
						   <th>Aksi</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$no= 0;
							foreach ($dataunitkerja->result() as $key => $row) { $id = $row->id_unit_kerja; 
							$no++;
						?>
						<tr>
						<td>
							<a href="#modalEdit<?php echo $id?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
							  <span class="btn btn-warning btn-xs">
								  <i class="fa fa-edit"></i>
							</a>
							<a href="#modalHapus<?php echo $id?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
							  <span class="btn btn-danger btn-xs">
								  <i class="fa fa-trash"></i>
							  </span>
							</a>
						</td>
						<td><?php echo $row->nama_unit_kerja; ?></td>
							
						</tr>
						<?php
						} 
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog role="document"">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Unit Kerja</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/unitkerja/tambah_unitkerja'?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Unit Kerja</label>
						<div class="col-sm-7">
							<input name="namaunitkerja" class="form-control" type="text" placeholder="Input Nama Unit Kerja..."  required>
						</div>
					</div>
		
				</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
				<button class="btn btn-info">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- ============ MODAL EDIT =============== -->
<?php
foreach ($dataunitkerja->result_array() as $a) {
	$idunitkerja=$a['id_unit_kerja'];
	$namaunitkerja=$a['nama_unit_kerja'];
?>
<div id="modalEdit<?php echo $idunitkerja?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Unit Kerja</h3>
			</div>
			
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/unitkerja/ubah_unitkerja'?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
					<input name="idunitkerja" type="hidden" value="<?php echo $idunitkerja;?>">
					<div class="form-group row">
						<label class="control-label col-sm-4" >Nama Unit Kerja</label>
						<div class="col-sm-7">
							<input name="namaunitkerja" class="form-control" type="text" value="<?php echo $namaunitkerja;?>" placeholder="Input Nama Unit Kerja..."  required>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
					<button type="submit" class="btn btn-info">Ubah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
}
?>

<!-- ============ MODAL LIHAT =============== -->
<?php
foreach ($dataunitkerja->result_array() as $a) {
	$idunitkerja=$a['id_unit_kerja'];
	$namaunitkerja=$a['nama_unit_kerja'];
?>
<div id="modalLihat<?php echo $idunitkerja?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Detil Unit Kerja</h3>
			</div>
			
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/unitkerja/lihat_unitkerja'?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
					<input name="idunitkerja" type="hidden" value="<?php echo $idunitkerja;?>">
					<div class="form-group row">
						<label class="control-label col-sm-4" >Nama Unit Kerja</label>
						<div class="col-sm-7">
							<input name="namaunitkerja" class="form-control" type="text" value="<?php echo $namaunitkerja;?>" placeholder="Input Nama Unit Kerja..."  required readonly>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Keluar</button>
				
				</div>
			</form>
		</div>
	</div>
</div>
<?php
}
?>

<!-- ============ MODAL HAPUS =============== -->
<?php
foreach ($dataunitkerja->result_array() as $a) {
	$id=$a['id_unit_kerja'];
?>
<div id="modalHapus<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Unit Kerja</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/unitkerja/hapus_unitkerja'?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				<p>Yakin mau menghapus data..?</p>
				<input name="idunitkerja" type="hidden" value="<?php echo $id; ?>">
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
<!-- /.content -->





