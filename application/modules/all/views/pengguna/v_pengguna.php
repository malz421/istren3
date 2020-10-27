
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Pengguna
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
					<a href="<?php echo base_url('all/pengguna/tambah_pengguna'); ?>" class="btn btn-sm btn-success" data-toggle="modal" >
					<span class="fa fa-plus"></span> Tambah Pengguna</a>
					<a href="<?php echo base_url('all/pengguna'); ?>" class="btn btn-sm btn-info">
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
							<th>Nama</th>
							<th>Lembaga</th>
							<th>User Name</th>
							<th>Hak Akses</th>
							<th>Password</th>
							<th>Pin</th>
							<th>Hak Antar Lembaga</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$no= 0;
							foreach ($datapengguna->result() as $key => $row) { $id = $row->id_pengguna; 
							$no++;
						?>
						<tr>
							<td>
							 <a href="#modalEdit<?php echo $id?>" data-toggle="modal" data-toggle="tooltip" title="Reset Password">
								<span class="btn btn-info btn-xs">
									<i class="fa fa-mail-forward"></i>
								</span>
							  </a>
							  <a href="<?php echo base_url('all/pengguna/ubah_pengguna/'.$id); ?>" title="Edit">
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
							<td><?php echo $row->nama_karyawan; ?></td>
							<td><?php echo $row->namalembaga; ?></td>
							<td><?php echo $row->user_name; ?></td>
							<td><?php echo $row->namarole; ?></td>
							<td style="-webkit-text-security: disc;"><?php echo $row->pass; ?></td>
							<td style="-webkit-text-security: disc;"><?php echo $row->pin; ?></td>
							<div class="icheckbox_minimal-blue checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" class="minimal" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
							<?php
							if ($row->akses_antar_lembaga=='Y'){?>
								<td><input type="checkbox" checked="checked" onclick="return false;"></td>
								
						    <?php
							}else
							{?>
								<td><input type="checkbox" onclick="return false;" ></td>
							<?php
							}
							?>
							
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



<!-- MODAL HAPUS -->

<!-- ============ MODAL HAPUS =============== -->
<?php
foreach ($datapengguna->result_array() as $a) {
	$id=$a['id_pengguna'];
?>
<div id="modalHapus<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Pengguna</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/pengguna/hapus_pengguna'?>">
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


<!-- ============ MODAL RESET PASSWORD =============== -->
<?php
foreach ($datapengguna->result_array() as $a) {
	$id=$a['id_pengguna'];
?>
<div id="modalEdit<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Reset Password</h3>
			</div>
			
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/pengguna/reset_password'?>">
				<div class="modal-body">
					<input name="idpengguna" type="hidden" value="<?php echo $id;?>">
					<div class="form-group row">
						<label class="control-label col-sm-4" >Password</label>
						<div class="col-sm-7">
							<input name="password" class="form-control" type="text"  placeholder="Input Passwor Baru" required >
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

<!--END MODAL-->
<!-- /.content -->





