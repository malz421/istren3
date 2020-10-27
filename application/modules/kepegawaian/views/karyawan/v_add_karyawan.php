
<section class="content-header">
	<h1>
		Tambah Karyawan
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
					<a href="<?php echo base_url('kepegawaian/karyawan'); ?>"  class="btn btn-sm btn-danger" >
					<span class="fa fa-mail-forward"></span> Kembali</a>
				</div>
			</div>
		</div>
	</div> 
	<!-- /.row -->
	<!-- Content -->
	<div class="row">
		<div class="col-lg-12">
		<form class="form-horizontal" method="post" action="<?php echo base_url().'kepegawaian/karyawan/simpan_karyawan'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
			<div class="box">
				<div class="box-body">
						<div class="form-group">
							<label class="col-md-3 control-label">NIP</label>
							<div class="col-md-6">
								<input type="text" name="nipkaryawan" maxlength="24" class="form-control" placeholder="Nomor induk pegawai otomatis" readonly/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3">Lembaga</label>
							<div class="col-sm-4">
								<select  <?php if( $this->session->userdata('akseslembaga') == "T" ) { ?>disabled="disabled"<?php } ?> class="form-control select2" name="idlembaga" id="idlembaga" style="width: 100%;">
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
							<label class="col-md-3 control-label">Unit Kerja</label>
							<div class="col-md-6">
								<select class="form-control select2" name="idunitkerja" id="idunitkerja" style="width: 100%;" required>
									<?php
									$no = 1;
									foreach($combounitkerja as $row) {
									?> 
										<option value="<?php echo $row->id_unit_kerja; ?>"><?php echo $row->nama_unit_kerja; ?></option>
									<?php
										$no++;}
									?>
								</select>
							</div>
						</div>

						

						<div class="form-group">
							<label class="col-md-3 control-label">NIK</label>
							<div class="col-md-6">
								<input type="number" name="nikkaryawan" maxlength="24" value="<?php echo set_value('nikkaryawan') ?>" class="form-control" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Nama Karyawan</label>

							<div class="col-sm-1">
								<input type="text" name="gelardepan" maxlength="64"  value="<?php echo set_value('gelardepan') ?>" class="form-control" />
								<small class="text-danger pl-3">Gelar Depan</small>
							</div>

							<div class="col-md-6">
								<input type="text" name="namakaryawan" maxlength="64" value="<?php echo set_value('namakaryawan') ?>" class="form-control" />
								<?php echo form_error('namakaryawan','<small class="text-danger pl-3">','</small>');?>
							</div>

							<div class="col-sm-1">
								<input type="text" name="gelarbelakang" maxlength="64" value="<?php echo set_value('gelardepan') ?>" class="form-control" />
								<small class="text-danger pl-3">Gelar Belakang</small>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Nama Panggilan</label>
							<div class="col-md-6">
								<input type="text" name="namapanggilan" maxlength="24" value="<?php echo set_value('namapanggilan') ?>" class="form-control" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Tempat, Tanggal Lahir</label>
							<div class="col-md-3">
								<input type="text" name="tempatlahir" maxlength="64"  class="form-control"/>
								<?php echo form_error('tempatlahir','<small class="text-danger pl-3">','</small>');?>
							</div>
							<div class="col-md-3">
								<div class="input-group date">
									<input type="text"  name="tgllahir" class="form-control pull-right" data-date-format="yyyy-mm-dd" id="datepicker">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
								</div>
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-md-3 control-label">Agama</label>
							<div class="col-md-6">
								<select name="agama" class="default-select2 form-control">
									<option value="Islam" selected>Islam</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Jenis Kelamin</label>
							<div class="col-md-6">
								<select name="jeniskelamin" class="default-select2 form-control">
									<option value="l" selected>Laki-laki
									<option value="p" >Perempuan
								</select>
							</div>
						</div>
	
          				<div class="form-group">
							<label class="control-label col-md-3">Golongan Darah</label>
							<div class="col-md-6">
								<select class="form-control select2" name="golongandarah" id="golongandarah" style="width: 100%;" required>
								<?php
								$no = 1;
								foreach($combogoldarah as $row) {
								?> 
									<option value="<?php echo $row->goldarah; ?>"><?php echo $row->goldarah; ?></option>
								<?php
									$no++;}
								?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Status Pernikahan</label>
							<div class="col-md-6">
							<select class="form-control select2" name="stsnikah" id="stsnikah" style="width: 100%;" required>
									<?php
									$no = 1;
									foreach($combonikah as $row) {
									?> 
										<option value="<?php echo $row->id_sts_nikah; ?>"><?php echo $row->ket_sts_nikah; ?></option>
									<?php
										$no++;}
									?>
									</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Status Kepegawaian</label>
							<div class="col-md-6">
							<select class="form-control select2" name="stskaryawan" id="stskaryawan" style="width: 100%;" required>
									<?php
									$no = 1;
									foreach($combostskaryawan as $row) {
									?> 
										<option value="<?php echo $row->id_sts_karyawan; ?>"><?php echo $row->ket_sts_karyawan; ?></option>
									<?php
										$no++;}
									?>
									</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Status Tinggal</label>
							<div class="col-md-6">
								<select class="form-control select2" name="ststinggal" id="ststinggal" style="width: 100%;" required>
									<?php
									$no = 1;
									foreach($comboststinggal as $row) {
									?> 
										<option value="<?php echo $row->id_sts_tinggal; ?>"><?php echo $row->ket_sts_tinggal; ?></option>
									<?php
										$no++;}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Status Aktif</label>
							<div class="col-md-6">
								<select class="form-control select2" name="stsaktif" id="stsaktif" style="width: 100%;" required>
									<?php
									$no = 1;
									foreach($combostskerja as $row) {
									?> 
										<option value="<?php echo $row->id_sts_karyaaktif; ?>"><?php echo $row->ket_sts_karyaaktif; ?></option>
									<?php
										$no++;}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Tanggal Mulai Kerja</label>
							<div class="col-md-6">
								<div class="input-group date">
									<input type="text" name="tglmulaikerja" value="<?php echo set_value('tglmulaikerja') ?>" class="form-control pull-right" data-date-format="yyyy-mm-dd" id="datepicker2">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<?php echo form_error('tglmulaikerja','<small class="text-danger pl-3">','</small>');?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Alamat</label>
							<div class="col-md-6">
								<textarea name="alamatkaryawan" maxlength="255" class="form-control"><?php echo set_value('alamatkaryawan') ?></textarea>
								<?php echo form_error('alamatkaryawan','<small class="text-danger pl-3">','</small>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">No. Hp</label>
							<div class="col-md-6">
								<input type="text" name="notlpkaryawan" maxlength="12" value="<?php echo set_value('notlpkaryawan') ?>" class="form-control" />
							</div>
						</div>

						

						<div class="form-group">
							<label class="col-md-3 control-label">Email</label>
							<div class="col-md-6">
								<input type="text" name="emailkaryawan" maxlength="64" value="<?php echo set_value('emailkaryawan') ?>"  class="form-control" />
								<?php echo form_error('emailkaryawan','<small class="text-danger pl-3">','</small>');?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Photo Profile</label>
							<div class="col-md-6">
								<img id="blah" name="photo" height="150px" width="150px" alt="" src="<?php echo base_url('assets/images/avatar.jpeg');?>"><br>
								<label style="width:150px;border-radius: 0px;margin-bottom:0px" class="btn btn-info btn-xs">Browse Foto
									<input enctype="multipart/form-data" type="file" style="width:150px;display:none;" id="image" name="filephoto" accept=".jpg,.png,image/*" capture onchange="readURL()">
								</label><br>
								<span style="color:red;font-size:14px;text-align:center"><i>Limit size (100 KB)</i></span>
							<div>
					    </div>

						<div class="modal-footer">
								<a class="btn btn-danger" href="<?php echo base_url('kepegawaian/karyawan'); ?>" id="Keluar"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> Batal</a>
								<button type="submit" class="btn btn-info">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
