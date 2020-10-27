<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Periode
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
					<span class="fa fa-plus"></span> Tambah Periode</a>
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
											<th>Nama Periode</th>
											<th>Tahun</th>
											<th>Bulan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($dataperiode as $key => $row) {$id = $row->id_periode;
											$no++;
											?>
											<tr>
												<td>
													<a href="#modalEdit<?php echo $id ?>" data-toggle="modal" data-toggle="tooltip" title="Edit">
														<span class="btn btn-warning btn-xs">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<a href="<?=base_url('kepegawaian/payroll/hapus_periode/'.$row->id_periode); ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus"  data-toggle="tooltip" title="Delete">
															<i class="fa fa-trash"></i>
													</a>
												</td>
												<td><?php echo $row->nama_periode; ?></td>
												<td><?php echo $row->tahun; ?></td>
												<td><?php echo bulan($row->bulan); ?></td>
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


		<!-- ============ MODAL EDIT =============== -->
<?php
foreach ($dataperiode as $a) {
    $idperiode = $a->id_periode;
    $namaperiode = $a->nama_periode;
    ?>
<div id="modalEdit<?php echo $idperiode ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Lembaga</h3>
			</div>

			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/edit_periode' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
				<div class="modal-body">
					<input name="idperiode" type="hidden" value="<?php echo $idperiode; ?>">
					<div class="form-group row">
						<label class="control-label col-sm-4" >Nama Periode</label>
						<div class="col-sm-7">
							<input name="txtnama" class="form-control" id="nama2" type="text" value="<?php echo $namaperiode; ?>" placeholder="Input Nama Lembaga..." readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-sm-4" >Bulan</label>
						<div class="col-sm-7">
							<select class="form-control" name="cmbbulan" onchange="nama_periode2()" id="bulan2" required>
								<option value="<?=$a->bulan; ?>" selected=""><?=bulan($a->bulan); ?></option>
								<option value="Januari">Januari</option>
								<option value="Febuari">Febuari</option>
								<option value="Maret">Maret</option>
								<option value="April">April</option>
								<option value="Mei">Mei</option>
								<option value="Juni">Juni</option>
								<option value="Juli">Juli</option>
								<option value="Agustus">Agustus</option>
								<option value="September">September</option>
								<option value="Oktober">Oktober</option>
								<option value="November">November</option>
								<option value="Desember">Desember</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-sm-4" >Tahun</label>
						<div class="col-sm-7">
							<input name="nmtahun" class="form-control" type="number" value="<?=$a->tahun; ?>" id="tahun2" onchange="nama_periode2()" required>
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
			
			<!-- ============ MODAL ADD =============== -->
			<div class="modal fade" id="largeModal" role="dialog" aria-labelledby="" aria-hidden="true">
		<div class="modal-dialog" role="document"
		>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></button>
				<div class="callout callout-success" id="myModalLabel">
					<h4>TAMBAH DATA PERIODE</h4>
				</div>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/add_periode' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">

					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Periode</label>
						<div class="col-sm-7">
							<input name="txtnama" value="" id="nama" class="form-control" type="text" placeholder="Input Nama Periode..." readonly="">
						</div>

					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-4" >Bulan</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="cmbbulan" onchange="nama_periode()" id="bulan" style="width: 100%;" required>
								<option selected="" disabled>==Pilih Bulan Periode==</option>
								<option value="Januari">Januari</option>
								<option value="Febuari">Febuari</option>
								<option value="Maret">Maret</option>
								<option value="April">April</option>
								<option value="Mei">Mei</option>
								<option value="Juni">Juni</option>
								<option value="Juli">Juli</option>
								<option value="Agustus">Agustus</option>
								<option value="September">September</option>
								<option value="Oktober">Oktober</option>
								<option value="November">November</option>
								<option value="Desember">Desember</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" >Tahun</label>
						<div class="col-sm-7">
							<input name="nmtahun" id="tahun"  class="form-control" type="number" placeholder="Input Tahun Periode..." onchange="nama_periode()" required>
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
