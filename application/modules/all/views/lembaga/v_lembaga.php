
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Lembaga
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
					<span class="fa fa-plus"></span> Tambah Lembaga</a>
					<a href="<?php echo base_url('all/lembaga'); ?>" class="btn btn-sm btn-info">
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
						</tr>
						</thead>
						<tbody>
						<?php
$no = 1;
foreach ($datalembaga->result() as $key => $row) {$id = $row->id_lembaga;
    $no++;
    ?>
						<tr>
							<!-- <td><input type="checkbox" name="checkid[]" class='checkid' value="<?php echo $id; ?>"></td> -->
							<td>
							  <a href="#modalEdit<?php echo $id ?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
								<span class="btn btn-warning btn-xs">
									<i class="fa fa-edit"></i>
								</span>
							  </a>
							  <a href="#modalHapus<?php echo $id ?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
								<span class="btn btn-danger btn-xs">
									<i class="fa fa-trash"></i>
								</span>
							  </a>
							</td>
							<td><?php echo $row->nama_lembaga; ?></td>
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
				<h3 class="modal-title" id="myModalLabel">Tambah Lembaga</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'all/lembaga/tambah_lembaga' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">

					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Lembaga</label>
						<div class="col-sm-7">
							<input name="lembaga" class="form-control" type="text" placeholder="Input Nama Lembaga..."  required>
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
foreach ($datalembaga->result_array() as $a) {
    $idlembaga = $a['id_lembaga'];
    $namalembaga = $a['nama_lembaga'];
    ?>
<div id="modalEdit<?php echo $idlembaga ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Lembaga</h3>
			</div>

			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'all/lembaga/ubah_lembaga' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
					<input name="idlembaga" type="hidden" value="<?php echo $idlembaga; ?>">
					<div class="form-group row">
						<label class="control-label col-sm-4" >Nama Lembaga</label>
						<div class="col-sm-7">
							<input name="lembaga" class="form-control" type="text" value="<?php echo $namalembaga; ?>" placeholder="Input Nama Lembaga..."  required>
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
foreach ($datalembaga->result_array() as $a) {
    $id = $a['id_lembaga'];
    ?>
<div id="modalHapus<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Lembaga</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'all/lembaga/hapus_lembaga' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				<p>Yakin mau menghapus data..?</p>
				<input name="idlembaga" type="hidden" value="<?php echo $id; ?>">
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





