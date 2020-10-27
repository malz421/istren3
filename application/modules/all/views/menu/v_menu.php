
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Menu Aplikasi
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
					<span class="fa fa-plus"></span> Tambah Menu</a>
					<a href="<?php echo base_url('all/menu'); ?>" class="btn btn-sm btn-info">
					<span class="fa fa-refresh"></span> Refresh</a>
					<a href="<?php echo base_url('all/menu'); ?>"  class="btn btn-sm btn-danger" >
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
						   <th>Kode Menu</th>
						   <th>Nama Menu</th>
						   <th>Parent Menu</th>
						   <th>Url</th>
						   <th>Status</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							
							foreach ($datamenu->result() as $a) {
								$id =$a->id;
								$idparent =$a->parent_id;
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
									<i class="fa fa-trash"></i>
								</span>
							  </a>
							 <a href="#modalTambah<?php echo $id?>" data-toggle="modal" data-toggle="tooltip" title="Tambah">
								<span class="btn btn-success btn-xs">
									<i class="fa fa-plus"></i>
								</span>
							  </a>
							</td>
							<td><?php echo $a->id ?></td>
							<td><?php echo $a->nama_menu ?></td>
							<td><?php echo $a->parent_menu; ?></td>
							<td><?php echo $a->url; ?></td>
							<td><?php if ($a->status==1){?>
									<span class="btn btn-success btn-xs">Active</span>
								<?php 
								}
								else
								{
								?>
								<span class="btn btn-warning btn-xs">Non Active</span>
								<?php
								}?>
												 
							</td>
						
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
<?php
foreach ($datamenu->result_array() as $a) {
	$idparent =$a['parent_id'];
?>
<div class="modal fade" id="modalTambah<?php echo $a['id']?>"  role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Menu</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/menu/tambah_menu'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
			
					<div class="form-group">
						<label class="control-label col-sm-4">Parent Menu</label>
						<div class="col-sm-7">
							<input type="hidden" name="idparent" value="<?php echo $a['id']; ?>" class="form-control" type="text" required>
							<input name="parentmenu" value="<?php echo $a['nama_menu']; ?>" class="form-control" type="text" required readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Menu</label>
						<div class="col-sm-7">
							<input name="namamenu" class="form-control" type="text" placeholder="Input Nama Menu...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Link Menu</label>
						<div class="col-sm-7">
							<input name="urlmenu" class="form-control" type="text" placeholder="Input Url...">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Icon</label>
						<div class="col-sm-7">
							<input name="icon" class="form-control" type="text" placeholder="Input Icon ">
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



<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="largeModal" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Menu</h3>
			</div>
		
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/menu/tambah_menu'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				

				<div class="form-group">
						<label class="control-label col-sm-4">Parent Menu</label>
						<div class="col-sm-7">
						<select class="form-control" name="idparent" id="idparent" style="width: 100%;">
								<option value="<?php echo '0'; ?>"><?php echo 'No Parent'; ?></option>
							  <?php
							  $no = 1;
							  foreach($combomenu as $row) {
							  ?> 
								<option value="<?php echo $row->id; ?>"><?php echo $row->parent_menu; ?></option>
							  <?php
								$no++;}
							  ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Menu</label>
						<div class="col-sm-7">
							<input name="namamenu" class="form-control" type="text"  placeholder="Input Nama Menu...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Link Menu</label>
						<div class="col-sm-7">
							<input name="urlmenu" class="form-control" type="text" placeholder="Input Url...">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Icon</label>
						<div class="col-sm-7">
							<input name="icon" class="form-control" type="text" placeholder="Input Icon ">
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
foreach ($datamenu->result_array() as $a) {
	$idparent =$a['parent_id'];
?>
<div id="modalEdit<?php echo $a['id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Menu</h3>
			</div>
		
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/menu/ubah_menu'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				

				<div class="form-group">
						<label class="control-label col-sm-4">Parent Menu</label>
						<div class="col-sm-7">
						    <input type="hidden" name="idmenu" value="<?php echo $a['id']; ?>" class="form-control" type="text" required>
							<input type="hidden" name="idparent" value="<?php echo $a['parent_id']; ?>" class="form-control" type="text" required>
							<input name="parentmenu" value="<?php echo $a['parent_menu']; ?>" class="form-control" type="text" required readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Menu</label>
						<div class="col-sm-7">
							<input name="namamenu" class="form-control" type="text"  value="<?php echo $a['nama_menu']; ?>" placeholder="Input Nama Menu...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Link Menu</label>
						<div class="col-sm-7">
							<input name="urlmenu" class="form-control" type="text" value="<?php echo $a['url']; ?>" placeholder="Input Url...">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Icon</label>
						<div class="col-sm-7">
							<input name="icon" class="form-control" type="text" value="<?php echo $a['icon']; ?>"placeholder="Input Icon ">
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
foreach ($datamenu->result_array() as $a) {
?>
<div id="modalLihat<?php echo $a['id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Detil Menu</h3>
			</div>
			
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
				<div class="form-group">
						<label class="control-label col-sm-4">Parent Menu</label>
						<div class="col-sm-7">
						    <input type="hidden" name="idmenu" value="<?php echo $a['id']; ?>" class="form-control" type="text" required>
							<input type="hidden" name="idparent" value="<?php echo $a['parent_id']; ?>" class="form-control" type="text" required>
							<input name="parentmenu" value="<?php echo $a['parent_menu']; ?>" class="form-control" type="text" required readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Menu</label>
						<div class="col-sm-7">
							<input name="namamenu" class="form-control" type="text"  value="<?php echo $a['nama_menu']; ?>" placeholder="Input Nama Menu..." readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Link Menu</label>
						<div class="col-sm-7">
							<input name="urlmenu" class="form-control" type="text" value="<?php echo $a['url']; ?>" placeholder="Input Url..." readonly>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Icon</label>
						<div class="col-sm-7">
							<input name="icon" class="form-control" type="text" value="<?php echo $a['icon']; ?>"placeholder="Input Icon" readonly >
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
foreach ($datamenu->result_array() as $a) {
	$id=$a['id'];
?>
<div id="modalHapus<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Hak Akses</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/menu/hapus_menu'?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				<p>Yakin mau menghapus data..?</p>
				<input name="idmenu" type="hidden" value="<?php echo $id; ?>">
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





