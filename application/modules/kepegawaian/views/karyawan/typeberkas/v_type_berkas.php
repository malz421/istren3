<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		List Type Berkas
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
					<span class="fa fa-plus"></span> Tambah Type Berkas</a>
						<a href="<?=base_url('kepegawaian/payroll/kategori_komponen'); ?>" class="btn btn-sm btn-info">
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
											<th>Nama Berkas</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($data_type_berkas as $key => $row) {$id = $row->id_type_berkas;
											$no++;
											?>
											<tr>
												<td>
													<a href="#modalEdit<?php echo $id ?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
														<span class="btn btn-warning btn-xs">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<a href="<?=base_url('kepegawaian/typeberkas/hapus_type_berkas/'.$row->id_type_berkas ); ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus"  data-toggle="tooltip" title="Delete">
															<i class="fa fa-trash"></i>
													</a>
												</td>
												<td><?php echo $row->nama_type_berkas; ?></td>
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
							<h3 class="modal-title" id="myModalLabel">Tambah Komponen Kategori</h3>
						</div>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>/kepegawaian/typeberkas/tambah_type_berkas">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<div class="modal-body">
								<div class="form-group">
									<label class="control-label col-sm-4" >Nama Type</label>
									<div class="col-sm-7">
										<input name="nama" class="form-control" type="text" placeholder="Input Type Berkas...">
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
foreach ($data_type_berkas as $a) {
    $id = $a->id_type_berkas;
    $nama = $a->nama_type_berkas;
    ?>
<div id="modalEdit<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Kategori</h3>
			</div>

			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/typeberkas/edit_type_berkas' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
					<div class="modal-body">
						<input type="text" name="id" value="<?=$id; ?>" hidden>
								<div class="form-group">
									<label class="control-label col-sm-4" >Nama Type</label>
									<div class="col-sm-7">
										<input name="nama" value="<?=$a->nama_type_berkas ?>" class="form-control" type="text" placeholder="Input Nama Type Berkas...">
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
	