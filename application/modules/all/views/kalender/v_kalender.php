
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Pengaturan Hari Libur
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
					<a href="<?php echo base_url('all/kalenderkerja'); ?>" class="btn btn-sm btn-info">
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
						   <th>Tanggal</th>
						   <th>Keterangan</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$no= 0;
							foreach ($datakalender->result() as $key => $row) { $id = $row->id_kalender; 
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
							<td><?php echo $row->tgl_kalender; ?></td>
							<td><?php echo $row->ket_kalender; ?></td>
						
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
				<h3 class="modal-title" id="myModalLabel">Tambah Hari Libur</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/kalenderkerja/tambah_kalender'?>" enctype="multipart/form-data">
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
                             <label class="control-label col-sm-4" >Tanggal</label>
                              <div class="col-md-7">
                                <div class="input-group date">
                                <input type="text"  name="tglkalender" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicker2">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <?php echo form_error('tglkalender', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                              </div>
                            </div>
					
							<div class="form-group">
						<label class="control-label col-sm-4" >Keterangan</label>
						<div class="col-sm-7">
							<input type='text' name="ketkalender" class="form-control" type="text">
						
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
foreach ($datakalender->result_array() as $a) {
?>
<div id="modalEdit<?php echo $a['id_kalender']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Ubah Hari Libur</h3>
			</div>
		
			<form class="form-horizontal" method="post" action="<?php echo base_url().'all/kalenderkerja/ubah_kalender'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				<div class="form-group">
						<input type="hidden" name="idkalender" id="idkalender" value="<?php echo $a['id_kalender']; ?>">
						<label class="control-label col-sm-4">Lembaga</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="idlembaga" id="idlembaga" style="width: 100%;" readonly>
							  <?php
							   $no = 1;
							  foreach($combolembaga as $row) {
							  ?> 
								<option value="<?php echo $row->id_lembaga; ?>"<?php if( $row->id_lembaga == $a['id_lembaga'] ) echo "selected=selected"?>><?php echo $row->nama_lembaga; ?></option>
							  <?php
								$no++;}
							  ?>
							</select>
						</div>
					</div>

				
					

					<div class="form-group">
                             <label class="control-label col-sm-4" >Tanggal</label>
                              <div class="col-md-7">
                                <div class="input-group date">
                                <input type="text"  name="tglkalender" value="<?php echo rubah_tanggal($a['tgl_kalender']); ?>" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicker3">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <?php echo form_error('tglmulaikerja', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                              </div>
                            </div>

				
					<div class="form-group">
						<label class="control-label col-sm-4" >Keterangan</label>
						<div class="col-sm-7">
							<input type='text' value="<?php echo $a['ket_kalender'] ?>"  name="ketkalender" class="form-control" >
						
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
foreach ($datakalender->result_array() as $a) {
?>
<div id="modalLihat<?php echo $a['id_kalender']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Detil Hari Libur</h3>
			</div>
			
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
				<div class="form-group">
						<label class="control-label col-sm-4">Lembaga</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="idlembaga" id="idlembaga" style="width: 100%;" disabled="disabled">
							  <?php
							   $no = 1;
							  foreach($combolembaga as $row) {
							  ?> 
								<option value="<?php echo $row->id_lembaga; ?>"<?php if( $row->id_lembaga == $a['id_lembaga'] ) echo "selected=selected"?>><?php echo $row->nama_lembaga; ?></option>
							  <?php
								$no++;}
							  ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
                             <label class="control-label col-sm-4" >Tanggal</label>
                              <div class="col-md-7">
                                <div class="input-group date">
                                <input type="text"  name="tglkalender" value="<?php echo rubah_tanggal($a['tgl_kalender']); ?>" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicker2" readonly>
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <?php echo form_error('tglmulaikerja', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                              </div>
                            </div>

				
					<div class="form-group">
						<label class="control-label col-sm-4" >Keterangan</label>
						<div class="col-sm-7">
							<input type='text' value="<?php echo $a['ket_kalender'] ?>"  name="ketkalender" class="form-control" readonly>
						
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
foreach ($datakalender->result_array() as $a) {
	$id=$a['id_kalender'];
?>
<div id="modalHapus<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Hari Libur</h3>
			</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url().'all/kalenderkerja/hapus_kalender'?>">
					<div class="modal-body">
					<p>Yakin mau menghapus data..?</p>
					<input name="idkalender" type="hidden" value="<?php echo $id; ?>">
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

<?php

function rubah_tanggal($date)
{
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    //result = $tgl . "-" . $BulanIndo[(int)$bulan-1]. "-". $tahun;
    $result = $tgl . "-" . $bulan . "-" . $tahun;
    return ($result);
}
?>
<!--END MODAL-->
<!-- /.content -->





