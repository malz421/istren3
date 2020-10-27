
<section class="content-header">
	<h1>
		Edit Profile
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
					<?php
						foreach ($datapengguna->result() as $a){
					?>
					<form class="form-horizontal" method="post" action="<?php echo base_url().'all/pengguna/reset_password'?>" enctype="multipart/form-data">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-group">
							<input name="idpengguna" id="idpengguna" type="hidden" class="form-control" value="<?php echo $a->id_pengguna ?>">
							<label class="control-label col-sm-3" >User Name</label>
							<div class="col-sm-6">
								<input name="username" id="username" class="form-control" value="<?php echo $a->user_name ?>" readonly="readonly" type="text" placeholder="Input User Name">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" >Password Baru</label>
							<div class="col-sm-6">
								<input name="password" id="password" class="form-control"  type="text" placeholder="Kosongkan Jika tidak berubah">
							</div>
						</div>
					

				  <?php
					}
				?>
					
						
				<div class="modal-footer">
					<a class="btn btn-danger" href="<?php echo base_url('all/admin_page'); ?>" id="Keluar"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> Batal</a>
					<button type="submit" class="btn btn-info">Simpan</button>
				</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</section>
