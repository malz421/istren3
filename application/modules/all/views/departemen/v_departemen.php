
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Departemen
	</h1>
</section>

<?php $akses = $this->session->userdata('akseslembaga'); ?>

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
					<span class="fa fa-plus"></span> Tambah Departemen</a>
					<a href="<?php echo base_url('all/departemen'); ?>" class="btn btn-sm btn-info">
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
						   <th>Lembaga</th>
						   <th>Departemen</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$no= 0;
							foreach ($datadepartemen->result() as $key => $row) { $id = $row->id_departemen; 
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
									<i class="fa fa-trash"></i>
								</span>
							  </a>
							</td>
							<td><?php echo $row->nama_lembaga; ?></td>
							<td><?php echo $row->nama_departemen; ?></td>
							
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
				<h3 class="modal-title" id="myModalLabel">Tambah Departemen</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/departemen/tambah_departemen'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-sm-4">Lembaga</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="idlembaga" id="idlembaga" style="width: 100%;">
							  <?php
							   $no = 1;
							  foreach($combolembaga as $row) {
							  ?> 
								<option value="<?php echo $row->id_lembaga; ?>"><?php echo $row->nama_lembaga; ?></option>
							  <?php
								$no++;}
							  ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Departemen</label>
						<div class="col-sm-7">
							<input name="namadepartemen" class="form-control" type="text" placeholder="Input Nama Departemen... "required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Keterangan Departemen</label>
						<div class="col-sm-7">
							<input type="textarea" name="ketdepartemen" class="form-control" type="text" placeholder="Input Keterangan Departemen...">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Kepala Departemen</label>
						<div class="col-sm-7">
							<input name="kepaladepartemen" class="form-control" type="text" placeholder="Input Kepala Departemen...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Alamat Departemen</label>
						<div class="col-sm-7">
							<textarea style="min-height: 150px; height: 0px;" elastic="" class="form-control" placeholder="Jalan / RT / RW / Dusun / Blok / Ds / Kec / Kab / Provinsi" name="alamatdepartemen"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Telepon1</label>
						<div class="col-sm-7">
							<input name="notlp1" class="form-control" type="text" placeholder="Input No Telepon...">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Telepon2</label>
						<div class="col-sm-7">
							<input name="notlp2" class="form-control" type="text" placeholder="Input No Telepon...">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Fax</label>
						<div class="col-sm-7">
							<input name="nofax" class="form-control" type="text" placeholder="Input No Fax...">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Email</label>
						<div class="col-sm-7">
							<input name="email" class="form-control" type="text" placeholder="Input Email...">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Website</label>
						<div class="col-sm-7">
							<input name="website" class="form-control" type="text" placeholder="Input Website...">
						</div>
					</div>
					
					 <div class="form-group">
					  <label class="control-label col-sm-4" >Logo</label>
					  <div class="col-sm-7">
						<input type="file" id="logo" name="logo" class="form-control">
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
foreach ($datadepartemen->result_array() as $a) {
?>
<div id="modalEdit<?php echo $a['id_departemen']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Departemen</h3>
			</div>
		
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/departemen/ubah_departemen'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					<div class="form-group">
						<label class="control-label col-sm-4" >Lembaga</label>
						<div class="col-sm-7">
							<input name="idlembaga"  value="<?php echo $a['nama_lembaga']; ?>" class="form-control" type="text" required readonly>
						</div>
					</div>
					<!--<div class="form-group">
						<label class="control-label col-sm-4">Lembaga</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="idlembaga" id="idlembaga" style="width: 100%;" readonly>
							  <?php
							   $no = 1;
							  foreach($combolembaga as $row) {
							  ?> 
								<option value="<?php echo $row->id_lembaga; ?>" <?php if($a['id_lembaga'] == $row->id_lembaga) { ?>selected="selected"<?php } ?>> <?php echo $row->nama_lembaga; ?></option>
							
							  <?php
								$no++;}
							  ?>
							</select>
						</div>
					</div>-->
					
					<input type="hidden" name="iddepartemen" id="iddepartemen" value="<?php echo $a['id_departemen']; ?>">
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Departemen</label>
						<div class="col-sm-7">
							<input name="namadepartemen"  value="<?php echo $a['nama_departemen']; ?>" class="form-control" type="text" required  >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Keterangan Departemen</label>
						<div class="col-sm-7">
							<input type="textarea" name="ketdepartemen" value="<?php echo $a['keterangan_departemen']; ?>" class="form-control" type="text" placeholder="Input Keterangan Departemen..."  required >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Kepala Departemen</label>
						<div class="col-sm-7">
							<input name="kepaladepartemen" value="<?php echo $a['kepala_departemen']; ?>" class="form-control" type="text" placeholder="Input Kepala Departemen...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Alamat Departemen</label>
						<div class="col-sm-7">
							<textarea style="min-height: 150px; height: 0px;" elastic="" class="form-control" 
							 placeholder="Jalan / RT / RW / Dusun / Blok / Ds / Kec / Kab / Provinsi" name="alamatdepartemen" ><?php echo $a['alamat_departemen']; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Telepon1</label>
						<div class="col-sm-7">
							<input name="notlp1" class="form-control" value="<?php echo $a['notlp_departemen']; ?>" type="text" placeholder="Input No Telepon..." >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Telepon2</label>
						<div class="col-sm-7">
							<input name="notlp2" class="form-control" value="<?php echo  $a['notlp_departemen2']; ?>" type="text" placeholder="Input No Telepon..." >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Fax</label>
						<div class="col-sm-7">
							<input name="nofax" class="form-control" value="<?php echo $a['fax_departemen']; ?>" type="text" placeholder="Input No Fax..." >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Email</label>
						<div class="col-sm-7">
							<input name="email" class="form-control" value="<?php echo  $a['email_departemen']; ?>" type="text" placeholder="Input Email..." >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Website</label>
						<div class="col-sm-7">
							<input name="website" class="form-control" value="<?php echo  $a['web_departemen']; ?>" type="text" placeholder="Input Website..." >
						</div>
					</div>
					
					 <div class="form-group">
					  <label class="control-label col-sm-4" >Logo</label>
					  <div class="col-sm-7">
						<input type="file" id="logo" name="logo" class="form-control" >
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
foreach ($datadepartemen->result_array() as $a) {
?>
<div id="modalLihat<?php echo $a['id_departemen']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Detil Departemen</h3>
			</div>
			
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					<div class="form-group">
						<label class="control-label col-sm-4" >Lembaga</label>
						<div class="col-sm-7">
							<input name="idlembaga"  value="<?php echo $a['nama_lembaga']; ?>" class="form-control" type="text" required readonly >
						</div>
					</div>
					<!--<div class="form-group">
						<label class="control-label col-sm-4">Lembaga</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="idlembaga" id="idlembaga" style="width: 100%;" readonly>
							  <?php
							   $no = 1;
							  foreach($combolembaga as $row) {
							  ?> 
								<option value="<?php echo $row->id_lembaga; ?>" <?php if($a['id_lembaga'] == $row->id_lembaga) { ?>selected="selected"<?php } ?>> <?php echo $row->nama_lembaga; ?></option>
							
							  <?php
								$no++;}
							  ?>
							</select>
						</div>
					</div>-->
					
					<input type="hidden" name="iddepartemen" id="iddepartemen" value="<?php echo $a['id_departemen']; ?>">
					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Departemen</label>
						<div class="col-sm-7">
							<input name="namadepartemen"  value="<?php echo $a['nama_departemen']; ?>" class="form-control" type="text" required readonly >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Keterangan Departemen</label>
						<div class="col-sm-7">
							<input type="textarea" name="ketdepartemen" value="<?php echo $a['keterangan_departemen']; ?>" class="form-control" type="text" placeholder="Input Keterangan Departemen..."  required readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Kepala Departemen</label>
						<div class="col-sm-7">
							<input name="kepaladepartemen" value="<?php echo $a['kepala_departemen']; ?>" class="form-control" type="text" placeholder="Input Kepala Departemen..." readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Alamat Departemen</label>
						<div class="col-sm-7">
							<textarea style="min-height: 150px; height: 0px;" elastic="" class="form-control" 
							 placeholder="Jalan / RT / RW / Dusun / Blok / Ds / Kec / Kab / Provinsi" name="alamatdepartemen" readonly ><?php echo $a['alamat_departemen']; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Telepon1</label>
						<div class="col-sm-7">
							<input name="notlp1" class="form-control" value="<?php echo $a['notlp_departemen']; ?>" type="text" placeholder="Input No Telepon..." readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Telepon2</label>
						<div class="col-sm-7">
							<input name="notlp2" class="form-control" value="<?php echo  $a['notlp_departemen2']; ?>" type="text" placeholder="Input No Telepon..." readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >No Fax</label>
						<div class="col-sm-7">
							<input name="nofax" class="form-control" value="<?php echo $a['fax_departemen']; ?>" type="text" placeholder="Input No Fax..." readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Email</label>
						<div class="col-sm-7">
							<input name="email" class="form-control" value="<?php echo  $a['email_departemen']; ?>" type="text" placeholder="Input Email..."readonly >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Website</label>
						<div class="col-sm-7">
							<input name="website" class="form-control" value="<?php echo  $a['web_departemen']; ?>" type="text" placeholder="Input Website..." readonly>
						</div>
					</div>
					
					 <div class="form-group">
					  <label class="control-label col-sm-4" >Logo</label>
					  <?php if(!empty($a['icon_departemen']))
											{
											?>	
												<img  class="col-sm-4" id="idlogo" name="photo" height="150px" width="150px" alt="" src="<?php echo base_url('storage/photo/departemen/'.$a['icon_departemen']);?>"><br>
												
											<?php
											}
							else
										{
										?>
											<img class="col-sm-4" id="idlogo" name="photo" height="150px" width="150px" alt="" src="<?php echo base_url('assets/images/avatar.jpeg');?>"><br>
										<?php
										}
						?>
		
					  
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
foreach ($datadepartemen->result_array() as $a) {
	$id=$a['id_departemen'];
	$icondepartemen=$a['icon_departemen'];
?>
<div id="modalHapus<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Jabatan</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/departemen/hapus_departemen'?>">
				<div class="modal-body">
				<p>Yakin mau menghapus data..?</p>
				<input name="iddepartemen" type="hidden" value="<?php echo $id; ?>">
				<input name="icondepartemen" type="hidden" value="<?php echo $icondepartemen; ?>">
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





