
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Hak Akses
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
					<span class="fa fa-plus"></span> Tambah Hak Akses</a>
					<a href="<?php echo base_url('all/menurole'); ?>" class="btn btn-sm btn-info">
					<span class="fa fa-refresh"></span> Refresh</a>
					<a href="<?php echo base_url('all/menurole'); ?>"  class="btn btn-sm btn-danger" >
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
						   <th>Hak Akses</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$no= 0;
							foreach ($datamenurole->result() as $key => $row) { $id = $row->id_menu_role; 
							$no++;
						?>
						<tr>
							<td>
							  <a href="#modalLihat<?php echo $id?>" data-toggle="modal" data-toggle="tooltip" title="Detil">
								<span class="btn btn-info btn-xs">
									<i class="fa fa-search"></i>
								</span>
							  </a>
							  <a href="#modalEdit<?php echo $id?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
								<span class="btn btn-warning btn-xs">
									<i class="fa fa-edit"></i>
								</span>
							  </a>
							  <a href="#modalHapus<?php echo $id?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
								<span class="btn btn-danger btn-xs">
									<i class="fa fa-times"></i>
								</span>
							  </a>
							</td>
							<td><?php echo $row->nama_menu_role; ?></td>
							
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
<div class="modal fade" id="largeModal" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Hak Akses</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/menurole/tambah_menu_role'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Hak Akses</label>
						<div class="col-sm-7">
							<input name="namarole" class="form-control" type="text" placeholder="Input Nama Hak Akses...">
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
foreach ($datamenurole->result_array() as $a) {
?>
<div id="modalEdit<?php echo $a['id_menu_role']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Hak Akses</h3>
			</div>
		
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/menurole/ubah_menu_role'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					<div class="form-group">
						<label class="control-label col-sm-4" >Hak Akses</label>
						<div class="col-sm-7">
							<input name="namarole"  value="<?php echo $a['nama_menu_role']; ?>" class="form-control" type="text" required>
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
<?php
}
?>


<!-- ============ MODAL LIHAT =============== -->
<?php
foreach ($datamenurole->result_array() as $a) {
?>
<div id="modalLihat<?php echo $a['id_menu_role']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Detil Hak Akses</h3>
			</div>
			
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					<div class="form-group">
						<label class="control-label col-sm-4" >Hak Akses</label>
						<div class="col-sm-7">
							<input name="namarole"  value="<?php echo $a['nama_menu_role']; ?>" class="form-control" type="text" required readonly >
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
foreach ($datamenurole->result_array() as $a) {
	$id=$a['id_menu_role'];
?>
<div id="modalHapus<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Hak Akses</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/menurole/hapus_menu_role'?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				<p>Yakin mau menghapus data..?</p>
				<input name="idrole" type="hidden" value="<?php echo $id; ?>">
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





