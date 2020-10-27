<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		List Status Karyawan
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
					<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal">
						<span class="fa fa-plus"></span> Tambah Status Karyawan</a>
						<a href="<?php echo base_url('all/statuskaryawan/'); ?>" class="btn btn-sm btn-info">
							<span class="fa fa-refresh"></span> Refresh</a>
							<button id="btn_kembali" class="btn btn-sm btn-danger">
								<span class="fa fa-mail-forward"></span> Kembali</button>
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
											<th>Ket Status Karyawan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($datastatus as $key => $row) {$id = $row->id_sts_karyawan ;
											$no++;
											?>
											<tr>
												<td>
													<a href="#modalEdit<?php echo $id ?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
														<span class="btn btn-warning btn-xs">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<a href="<?=base_url('all/statuskaryawan/hapus_status_karyawan/'.$row->id_sts_karyawan); ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus"  data-toggle="tooltip" title="Delete">
															<i class="fa fa-trash"></i>
													</a>
												</td>
												<td><?php echo $row->ket_sts_karyawan; ?></td>
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
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
							<h3 class="modal-title" id="myModalLabel">Tambah Status Karyawan</h3>
						</div>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>/all/statuskaryawan/tambah_status_karyawan">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label col-sm-4" >Ket Status Karyawan</label>
									<div class="col-sm-7">
										<input name="ket" id="ket" class="form-control" type="text" placeholder="Input Status Karyawan...">
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
foreach ($datastatus as $a) {
    $id = $a->id_sts_karyawan ;
    $ket = $a->ket_sts_karyawan;
    ?>
<div id="modalEdit<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Status Karyawan</h3>
			</div>

			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/statuskaryawan/ubah_status_karyawan' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
				<div class="modal-body">
					<input name="id" type="hidden" value="<?php echo $id; ?>">
					<div class="form-group row">
						<label class="control-label col-sm-4" >Ket Status Karyawan</label>
						<div class="col-sm-7">
							<input name="ket" class="form-control" id="nama2" type="text" value="<?php echo $ket; ?>" placeholder="Input Status Karyawan..."  required>
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
	


