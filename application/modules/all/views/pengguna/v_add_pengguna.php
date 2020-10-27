
<section class="content-header">
	<h1>
		Pengguna
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
					<a href="<?php echo base_url('all/pengguna'); ?>"  class="btn btn-sm btn-danger" >
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
					<form class="form-horizontal" method="post" action="<?php echo base_url().'all/pengguna/simpan_pengguna'?>" enctype="multipart/form-data">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-group">
							<label class="control-label col-sm-3">Lembaga</label>
							<div class="col-sm-6">
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
							<label class="control-label col-sm-3" >Nama Pengguna</label>
							<div class="col-sm-6">
								<select class="form-control select2" name="nikpengguna" id="nikpengguna" style="width: 100%;">
								<?php
								$no = 1;
								foreach($combopengguna as $row) {
								?> 
									<option value="<?php echo $row->id_karyawan; ?>"><?php echo $row->nama_karyawan ; ?></option>
								<?php
									$no++;}
								?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" > Role Akses</label>
							<div class="col-sm-6">
								<select class="form-control select2" name="idrole" id="idrole" style="width: 100%;">
								<?php
								$no = 1;
								foreach($comboakses as $row) {
								?> 
									<option value="<?php echo $row->id_menu_role; ?>"><?php echo $row->nama_menu_role ; ?></option>
								<?php
									$no++;}
								?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3" >User Name</label>
							<div class="col-sm-6">
								<input name="username" id="username" class="form-control" value="<?php echo set_value('username') ?>" type="text" placeholder="Input User Name">
								<?php echo form_error('username','<small class="text-danger pl-3">','</small>');?>
							</div>
						</div>
					
						<div class="form-group">
							<label class="control-label col-sm-3" >Password</label>
							<div class="col-sm-6">
								<input name="password" class="form-control"  type="password" placeholder="Input Password">
								<?php echo form_error('password','<small class="text-danger pl-3">','</small>');?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3" >Pin</label>
							<div class="col-sm-6">
								<input  name="pin" class="form-control" type="password" placeholder="Input Pin Minimal 6 karakter">
								<?php echo form_error('pin','<small class="text-danger pl-3">','</small>');?>
							</div>
						</div>
				<div class="modal-footer">
					<a class="btn btn-danger" href="<?php echo base_url('all/pengguna'); ?>" id="Keluar"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> Batal</a>
					<button type="submit" class="btn btn-info">Simpan</button>
				</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</section>
