<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		List Kategori
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
						<span class="fa fa-plus"></span> Tambah Kategori</a>
						<a href="<?php echo base_url('kepegawaian/Payroll/periode_penggajian'); ?>" class="btn btn-sm btn-info">
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
											<th>Nama Kategori</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($datakategori as $key => $row) {$id = $row->id_group_kategori_komponen;
											$no++;
											?>
											<tr>
												<td>
													<a href="#modalEdit<?php echo $id ?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
														<span class="btn btn-warning btn-xs">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<a href="<?=base_url('kepegawaian/payroll/hapus_kategori/'.$row->id_group_kategori_komponen); ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus"  data-toggle="tooltip" title="Delete">
															<i class="fa fa-trash"></i>
													</a>
												</td>
												<td><?php echo $row->nama_kategori; ?></td>
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
							<h3 class="modal-title" id="myModalLabel">Tambah Kategori</h3>
						</div>
						<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/tambah_kategori' ?>">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label col-sm-4" >Nama Kategori</label>
									<div class="col-sm-7">
										<input name="txtnama" id="nama" class="form-control" type="text" placeholder="ex.(Pendapatan,Potongan,Informasi)">
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
foreach ($datakategori as $a) {
    $idkategori = $a->id_group_kategori_komponen;
    $namakategori = $a->nama_kategori;
    ?>
<div id="modalEdit<?php echo $idkategori ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Kategori</h3>
			</div>

			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/edit_kategori' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
				<div class="modal-body">
					<input name="idkategori" type="hidden" value="<?php echo $idkategori; ?>">
					<div class="form-group row">
						<label class="control-label col-sm-4" >Nama Periode</label>
						<div class="col-sm-7">
							<input name="txtnama" class="form-control" id="nama2" type="text" value="<?php echo $namakategori; ?>" placeholder="Input Nama Lembaga..."  required>
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
	


