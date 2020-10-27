<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		List Kategori Komponen
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
					<span class="fa fa-plus"></span> Tambah Kategori Komponen</a>
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
											<th>Nama Komponen</th>
											<th>Kategori</th>
											<th>Tanggal Buat</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($datakomponenkategori as $key => $row) {$id = $row->id_komponen_gaji;
											$no++;
											?>
											<tr>
												<td>
													<a href="#modalEdit<?php echo $id ?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
														<span class="btn btn-warning btn-xs">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<a href="<?=base_url('kepegawaian/payroll/hapus_kategori_komponen/'.$row->id_komponen_gaji ); ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus"  data-toggle="tooltip" title="Delete">
															<i class="fa fa-trash"></i>
													</a>
												</td>
												<td><?php echo $row->nama_kategori_komponen; ?></td>
												<td><?php echo $row->nama_kategori; ?></td>
												<td><?php echo $row->create_at; ?></td>
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
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>/kepegawaian/payroll/tambah_kategori_komponen">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<div class="modal-body">

								<div class="form-group">
									<label class="control-label col-sm-4" >Kategori</label>
									<div class="col-sm-7">
										<select class="form-control" name="Kategori" required="">
											<option>Pilih Kategori</option>
											<?php foreach ($datakategori as $key): ?>
												<option value="<?=$key->id_group_kategori_komponen; ?>"><?=$key->nama_kategori; ?></option>
											<?php endforeach ?>
										</select>
									</div>

								</div>
								<div class="form-group">
									<label class="control-label col-sm-4" >Nama Komponen</label>
									<div class="col-sm-7">
										<input name="nama_kategori_komponen" name="nama_kategori_komponen" class="form-control" type="text" placeholder="ex.(Gaji Pokok,THR,Pinjaman)." required="">
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
foreach ($datakomponenkategori as $a) {
    $id = $a->id_komponen_gaji;
    $nama = $a->nama_kategori_komponen;
    ?>
<div id="modalEdit<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Kategori</h3>
			</div>

			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/edit_kategori_komponen' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
					<div class="modal-body">
						<input type="text" name="id" value="<?=$id; ?>" hidden>
								<div class="form-group">
									<label class="control-label col-sm-4" >Kategori</label>
									<div class="col-sm-7">
										<select class="form-control" name="Kategori" required="">
											<option value="<?=$a->id_group_kategori_komponen; ?>" selected><?=$a->nama_kategori; ?></option>
											<?php foreach ($datakategori as $key): ?>
												<option value="<?=$key->id_group_kategori_komponen; ?>"><?=$key->nama_kategori; ?></option>
											<?php endforeach ?>
										</select>
									</div>

								</div>
								<div class="form-group">
									<label class="control-label col-sm-4" >Nama Komponen</label>
									<div class="col-sm-7">
										<input name="nama_kategori_komponen" value="<?=$a->nama_kategori_komponen ?>"name="nama_kategori_komponen" class="form-control" type="text" placeholder="Input Nama Komponen...">
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
	