
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Jabatan
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
					<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#addmodal">
					<span class="fa fa-plus"></span> Tambah Jabatan</a>
					<a href="<?php echo base_url('all/jabatan'); ?>" class="btn btn-sm btn-info">
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
						   <th>Aksi</th>
						   <th>Jabatan</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$no= 0;
							foreach ($datajabatan->result() as $key => $row) { $id = $row->id_jabatan; 
							$no++;
						?>
						<tr>
							<td>
							  <a href="#modalEdit<?php echo $id?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
								<span class="btn btn-warning btn-xs">
									<i class="fa fa-edit"></i>
								</span>
							  </a>
							  <a href="#modalHapus<?php echo $id?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
								<span class="btn btn-danger btn-xs">
									<i class="fa fa-trash"></i>
								</span>
							  </a>
							</td>
							<td><?php echo $row->nama_jabatan; ?></td>
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
<div class="modal fade" id="addmodal" tabindex="-1" role="form" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Jabatan</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'all/jabatan/tambah_jabatan' ?>">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Jabatan</label>
						<div class="col-sm-7">
							<input id="jabatan" name="jabatan" class="form-control" type="text" placeholder="Input Nama Jabatan..." required>
						</div>
						
					</div>
		
				</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
				<button type="submit" class="btn btn-info" >Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- ============ MODAL EDIT =============== -->
<?php
foreach ($datajabatan->result_array() as $a) {
	$idjabatan=$a['id_jabatan'];
	$namajabatan=$a['nama_jabatan'];
?>
<div id="modalEdit<?php echo $idjabatan?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Jabatan</h3>
			</div>
			
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/jabatan/ubah_jabatan'?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
					<input name="idjabatan" type="hidden" value="<?php echo $idjabatan;?>">
					<div class="form-group row">
						<label class="control-label col-sm-4" >Nama Jabatan</label>
						<div class="col-sm-7">
							<input name="jabatan" class="form-control" type="text" value="<?php echo $namajabatan;?>" placeholder="Input Nama Lembaga..."  required>
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

<!-- ============ MODAL HAPUS =============== -->
<?php
foreach ($datajabatan->result_array() as $a) {
	$id=$a['id_jabatan'];
?>
<div id="modalHapus<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Jabatan</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/jabatan/hapus_jabatan'?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				<p>Yakin mau menghapus data..?</p>
				<input name="idjabatan" type="hidden" value="<?php echo $id; ?>">
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





