<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		List Template Gaji
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
					<a class="btn btn-sm btn-success" href="<?=base_url(); ?>kepegawaian/payroll/add_teamplate">
					<span class="fa fa-plus"></span> Tambah Template</a>
						<a href="#" class="btn btn-sm btn-info">
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
											<th>Nama Template</th>
											<th>Lembaga</th>
											<th>Tanggal Buat</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($datateamplate as $key => $row) {$id = $row->id_teamplate;
											$no++;
											?>
											<tr>
												<td>
													<a href="<?=base_url('kepegawaian/payroll/edit_teamplate/'.$row->id_teamplate) ?>"  title="Edit">
														<span class="btn btn-warning btn-xs">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<a href="<?=base_url('kepegawaian/payroll/hapus_teamplate/'.$row->id_teamplate); ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus"  data-toggle="tooltip" title="Delete">
															<i class="fa fa-trash"></i>
													</a>
												</td>
												<td><?php echo $row->nama_teamplate; ?></td>
												<td><?php echo $row->nama_lembaga; ?></td>
												<td><?php echo $row->tgl; ?></td>
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

			