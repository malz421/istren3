
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Hak Akses Menu
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
					<div class="pull-left col-xs-6">
					<div class="form-group">
					  
						<label class="control-label col-sm-4">Pilih Hak Akses</label>
						<div class="col-sm-7">
							<select class="form-control" name="idrole" id="idrole" style="width: 100%;">
							  <?php
							  $no = 1;
							  foreach($comboakses as $row) {
							  ?> 
								<option value="<?php echo $row->id_menu_role; ?>"><?php echo $row->nama_menu_role; ?></option>
							  <?php
								$no++;}
							  ?>
							</select>
						</div>
					</div>
					</div>

					<div class="pull-right">
						<a href="<?php echo base_url('all/menu'); ?>"  class="btn btn-sm btn-danger" >
						<span class="fa fa-mail-forward"></span> Kembali</a>
					</div>
								
					
				</div>
			</div>
		</div>
	</div> 

	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">


					<table  id="show_data" class="table table-bordered table-striped" style="font-size:14px;">
					<thead>
							<tr>
								<th>Akses Menu</th>
								<th>Parent Menu</th>
								<th>Nama Menu</th>
								<th>Tambah</th>
								<th> Ubah</th>
								<th>Hapus</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
    <div>
</section>

	<!-- /.row -->
	<!-- Content -->

<!--END MODAL-->
<!-- /.content -->





