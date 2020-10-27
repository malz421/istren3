
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Penganturan Absen Shift
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
					<span class="fa fa-plus"></span> Tambah</a>
					<a href="<?php echo base_url('all/Absen_pola'); ?>" class="btn btn-sm btn-info">
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
						   <th>Kode Shift</th>
						   <th>Nama Shift</th>
						   <th>Jam Masuk</th>
						   <th>Jam Keluar</th>
						</tr>
						</thead>
						<tbody>
						<?php
$no = 0;
foreach ($dataabsen->result() as $key => $row) {$id = $row->id_shift;
    $no++;
    ?>
						<tr>
							<td>
							  <a href="#modalLihat<?php echo $id ?>" data-toggle="modal" data-toggle="tooltip" title="Detil">
								<span class="btn btn-info btn-xs">
									<i class="fa fa-search"></i>
								</span>
							  </a>
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
							<td><?php echo $row->kode_shift; ?></td>
							<td><?php echo $row->nama_shift; ?></td>
							<td><?php echo substr($row->jam_masuk, 0, 5); ?></td>
							<td><?php echo substr($row->jam_keluar, 0, 5); ?></td>



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
	<div class="modal-dialog role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Absen Shift</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'all/Absen_pola/tambah_absen_pola' ?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">


					<div class="form-group">
						<label class="control-label col-sm-4" >Kode Shift</label>
						<div class="col-sm-7">
							<input type="text" name="kodeshift" class="form-control" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Shift</label>
						<div class="col-sm-7">
							<input type="text" name="namashift" class="form-control" required >
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Jam Masuk</label>
						<div class="col-sm-7">
							<input data-date-format="HH:mm" type='text' id="jammasuk" name="jammasuk" class="form-control timepicker" type="text" placeholder="00:00">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Jam Keluar</label>
						<div class="col-sm-7">
							<input data-date-format="HH:mm" type='text' id="jamkeluar" name="jamkeluar" class="form-control timepicker" type="text" placeholder="00:00">
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
foreach ($dataabsen->result_array() as $a) {
    ?>
<div id="modalEdit<?php echo $a['id_shift'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Edit Absen Shift</h3>
			</div>

			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'all/Absen_pola/ubah_absen_pola' ?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
					<input name="idshift" type="hidden" value="<?php echo $id; ?>">
					<div class="form-group">
						<label class="control-label col-sm-4" >Kode Shift</label>
						<div class="col-sm-7">
							<input type="text" name="kodeshift" value="<?php echo $a['kode_shift']; ?>" class="form-control" required readonly>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Shift</label>
						<div class="col-sm-7">
							<input type="text" name="namashift" value="<?php echo $a['nama_shift']; ?>" class="form-control" required >
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-sm-4" >Jam Masuk</label>
						<div class="col-sm-7 ">
							<input data-date-format="HH:mm" value="<?php echo $a['jam_masuk'] ?>"   type='text' id="jammasuk" name="jammasuk" class="form-control timepicker" type="text" placeholder="00:00">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Jam Keluar</label>
						<div class="col-sm-7">
							<input data-date-format="HH:mm" value="<?php echo $a['jam_keluar'] ?>" type='text' id="jamkeluar" name="jamkeluar" class="form-control timepicker" type="text" placeholder="00:00">
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
foreach ($dataabsen->result_array() as $a) {
    ?>
<div id="modalLihat<?php echo $a['id_shift'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Detil Absen Shift</h3>
			</div>

			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">


				   <div class="form-group">
						<label class="control-label col-sm-4" >Kode Shift</label>
						<div class="col-sm-7">
							<input type="text" name="kodeshift" value="<?php echo $a['kode_shift']; ?>" class="form-control" readonly >
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Nama Shift</label>
						<div class="col-sm-7">
							<input type="text" name="namashift" value="<?php echo $a['nama_shift']; ?>" class="form-control" readonly >
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Jam Masuk</label>
						<div class="col-sm-7">
							<input data-date-format="HH:mm" value="<?php echo $a['jam_masuk'] ?>"   type='text' id="jammasuke" name="jammasuk" class="form-control timepicker" type="text" placeholder="00:00" readonly>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4" >Jam Keluar</label>
						<div class="col-sm-7">
							<input data-date-format="HH:mm" value="<?php echo $a['jam_keluar'] ?>" type='text' id="jamkeluare" name="jamkeluar" class="form-control timepicker" type="text" placeholder="00:00" readonly>
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
foreach ($dataabsen->result_array() as $a) {
    $id = $a['id_shift'];
    ?>
<div id="modalHapus<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Absen Shift</h3>
			</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url() . 'all/Absen_pola/hapus_absen_pola' ?>">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
					<div class="modal-body">
					<p>Yakin mau menghapus data..?</p>
					<input name="idshift" type="hidden" value="<?php echo $id; ?>">
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





