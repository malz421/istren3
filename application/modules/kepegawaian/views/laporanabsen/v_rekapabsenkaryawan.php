
<!-- Judul Header -->


<section class="content-header">
	<h1>
		Rekap Absensi Per Karyawan
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
				<div class="pull-right" >
					<a href="<?php echo base_url('all/admin_page'); ?>"  class="btn btn-sm btn-danger" >
					<span class="fa fa-mail-forward"></span> Kembali</a>
				</div>
				</div>
			</div>
		</div>
	</div> 


	<div class="row">
		<div class="col-md-6">
			<form class="form-horizontal" id="absenrekapkaryawan" method="post" enctype="multipart/form-data" >
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
					</div>
					<!-- /.box-header -->
					<!-- form start -->

					<?php
							if (isset($_POST['idunitkerja'])){
							   $idunitkerja =  $_POST['idunitkerja']; 
							}
							
							if (isset($_POST['idlembaga'])){
							   $idlembaga =  $_POST['idlembaga'];
							}
					
							
							if (isset($_POST['idkaryawan'])){
							   $idkarywan =  $_POST['idkaryawan'];
							}

							if (isset($_POST['tglperiode1'])){
							   $tglawal =  $_POST['tglperiode1'];
							}

							if (isset($_POST['tglperiode2'])){
							   $tglakhir =  $_POST['tglperiode2'];
							}
							


							?>
				
					<div class="box-body">
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
									<label class="col-sm-3 control-label">Unit Kerja</label>
									<div class="col-sm-6">
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
									<label class="col-sm-3 control-label">Nama Karyawan</label>
									<div class="col-sm-6">
										<select class="form-control select2" name="idkaryawan" id="idkaryawan" style="width: 100%;" required>
										</select>
									</div>
								</div>


								<div class="form-group">
										<label class="col-sm-3 control-label">Periode</label>
										<div class="col-sm-4">
											<div class="input-group date">
												<input type="text" id="tglperiode1" name="tglperiode1" value="<?php echo date('d-m-Y') ?>" class="form-control pull-right" data-date-format="dd-mm-yyyy" >
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<?php echo form_error('tglperiode1','<small class="text-danger pl-3">','</small>');?>
											</div>
										</div>

										<div class="col-sm-4">
											<div class="input-group date">
												<input type="text" id="tglperiode2" name="tglperiode2" value="<?php echo date('d-m-Y') ?>" class="form-control pull-right" data-date-format="dd-mm-yyyy" >
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<?php echo form_error('tglperiode2','<small class="text-danger pl-3">','</small>');?>
											</div>
										</div>
									</div>


					</div>
					<div class="box-footer">
						<button onclick="reload_rekapabsenkaryawan()" id="submit" class="btn btn-sm btn-info" type="button"><i class="fa fa-search"></i> Proses</button>
					</div>
					<!-- /.box-body -->

				</div>
				</form>
		</div>

		<div class="col-md-6">
			<div class="form-horizontal">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
					</div>
					<!-- /.box-header -->
					<!-- form start -->
				
					<div class="box-body">

								<?php 
								$row = $rekapabsen->row();
								if ($row){
									$jmlalpa = $row->jmlalpa;
									$jmlijin = $row->jmlijin;
									$jmlsakit = $row->jmlsakit;
									$jmlhadirterlambat = $row->jmlhadirterlambat;
									$menitlebihmasuk = $row->menitmasuk;
									$menitlebihkeluar = $row->menitkeluar;
								}
								else
								{
									$jmlalpa = 0;
									$jmlijin = 0;
									$jmlsakit = 0;
									$jmlhadirterlambat = 0;
									$menitlebihmasuk = 0;
									$menitlebihkeluar = 0;
								}

							
								?>
					

			
								<div class="form-group">
									<label class="control-label col-sm-5">Akumulasi Keterlambatan Waktu</label>
									<label class="control-label col-sm-1">:</label>
									<label class="control-label col-sm-1"><?php echo $menitlebihmasuk; ?></label>
									<label class="control-label col-sm-1">(menit)</label>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-5">Akumulasi Kelebihan Waktu</label>
									<label class="control-label col-sm-1">:</label>
									<label class="control-label col-sm-1"><?php echo $menitlebihkeluar; ?></label>
									<label class="control-label col-sm-1">(menit)</label>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-5">Alpa </label>
									<label class="control-label col-sm-1">:</label>
									<label class="control-label col-sm-1"><?php echo $jmlalpa; ?> </label>
									<label class="control-label col-sm-1">(hari)</label>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-5">Sakit </label>
									<label class="control-label col-sm-1">:</label>
									<label class="control-label col-sm-1"><?php echo  $jmlsakit; ?></label>
									<label class="control-label col-sm-1">(hari)</label>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-5">Ijin </label>
									<label class="control-label col-sm-1">:</label>
									<label class="control-label col-sm-1"><?php echo  $jmlijin; ?></label>
									<label class="control-label col-sm-1">(hari)</label>
								</div>

								
		 				
				
					</div>
					<div class="box-footer">
					<a id="exprekapabsenkaryawan" href="<?php echo base_url('kepegawaian/laporanabsen/exp_rekap_absensi_karyawan'); ?>" class="btn btn-sm btn-success">
							<span class="fa fa-file-excel-o"></span> Export Absensi karyawan</a>
					</div>

					</div>
					<!-- /.box-body -->

				</div>
				
		</div>


		<!--DATA ABSEN-->
		<div class="dataabsen" id="dataabsen"></div>

		<!--<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
			
					<table class="table table-bordered table-striped table-hover" style="font-size:14px;width:100%" id="example2">
						<thead>
						<tr>
						   <th>No</th>
						   <th>Tanggal</th>
						   <th>Absensi</th>
						   <th>Jam Masuk</th>
						   <th>Lebih Masuk</th>
						   <th>Keterangan Masuk</th>
						   <th>Jam Pulang</th>
						   <th>Lebih Pulang</th>
						   <th>Keterangan Pulang</th>
						   <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$no= 0;
							foreach ($rekapabsen->result() as $key => $row) { $id = $row->id_karyawan; 
							$no++;
						?>
						<tr>
						    <td><?php echo $no; ?></td>
							
							<td><?php echo $row->tgl_absen; ?></td>
							<td><?php echo $row->id_sts_hadir; ?></td>
							<td><?php echo $row->jam_masuk; ?></td>
							<td><?php echo $row->menit_lebih_masuk; ?></td>
							<td><?php echo $row->ket_hadir; ?></td>
							<td><?php echo $row->jam_keluar; ?></td>
							<td><?php echo $row->menit_lebih_keluar; ?></td>
							<td><?php echo $row->ket_pulang; ?></td>
							<td>
							  <a href="<?php echo base_url('kepegawaian/karyawan/detail_karyawan/'.$id); ?>" title="Detil">
								<span class="btn btn-info btn-xs">
									<i class="fa fa-search"></i>
								</span>
							  </a>
							  <a href="<?php echo site_url('kepegawaian/karyawan/ubah_karyawan/'.$id); ?>" title="Edit">
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
						</tr>
						<?php
						} 
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>-->



		


</section>
	


<!--END MODAL-->
<!-- /.content -->





