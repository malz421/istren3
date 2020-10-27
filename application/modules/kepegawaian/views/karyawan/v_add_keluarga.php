
<section class="content-header">
	<h1>
		Tambah Keluarga
	</h1>
</section>


<!-- Main content -->
<section class="content">
<!-- Page Heading -->
	
	<!-- /.row -->
	<!-- Content -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
					<form class="form-horizontal" method="post" action="<?php echo base_url().'kepegawaian/karyawan/simpan_keluarga'?>" enctype="multipart/form-data">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="modal-body">
						    <input name="idkaryawan" value="<?php echo $idkaryawan; ?>"  class="form-control" type="hidden" >

							<div class="form-group">
								<label class="control-label col-sm-3" >NIK</label>
								<div class="col-sm-6">
									<input name="nikkel" class="form-control" type="text" placeholder="Input NIK ">
								</div>
							</div>
									
							<div class="form-group">
								<label class="control-label col-sm-3" >Nama</label>
								<div class="col-sm-6">
									<input name="namakel" class="form-control" type="text" placeholder="Input Nama ">
									<?php echo form_error('namakel','<small class="text-danger pl-3">','</small>');?>
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-md-3 control-label">Tanggal lahir</label>
								<div class="col-md-6">
									<div class="input-group date">
										<input type="text" name="tgllhrkel"  class="form-control pull-right" data-date-format="yyyy-mm-dd" id="datepickeluarga">
										<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
										</div>
									</div>
									<?php echo form_error('tgllhrkel','<small class="text-danger pl-3">','</small>');?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Jenis Kelamin</label>
								<div class="col-md-6">
									<select name="jkkel" class="default-select2 form-control">
										<option value="l" selected>Laki-laki
										<option value="p" >Perempuan
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Hubungan</label>
								<div class="col-md-6">
									<select class="form-control select2" name="hubkel" id="hubkel" style="width: 100%;" required>
									<?php
									$no = 1;
									foreach($combohubungan as $row) {
									?> 
										<option value="<?php echo $row->id_hubungan; ?>"><?php echo $row->nama_hubungan; ?></option>
									<?php
										$no++;}
									?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Pendidikan</label>
								<div class="col-md-6">
									<select class="form-control select2" name="penkel" id="penkel" style="width: 100%;" required>
									<?php
									$no = 1;
									foreach($combopendidikan as $row) {
									?> 
										<option value="<?php echo $row->id_tingkat; ?>"><?php echo $row->ket_tingkat; ?></option>
									<?php
										$no++;}
									?>
									</select>
								</div>
							</div>
	
							<div class="form-group">
								<label class="control-label col-md-3">Pekerjaan</label>
								<div class="col-md-6">
									<select class="form-control select2" name="kerjakel" id="kerjakel" style="width: 100%;" required>
									<?php
									$no = 1;
									foreach($combopekerjaan as $row) {
									?> 
										<option value="<?php echo $row->id_kerja; ?>"><?php echo $row->nama_pekerjaan; ?></option>
									<?php
										$no++;}
									?>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
						   <a href="<?php echo base_url('kepegawaian/karyawan/ubah_karyawan/'.$idkaryawan); ?>"  class="btn btn-sm btn-danger" >
							<span class="fa fa-mail-forward"></span> Batal</a>
							<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
