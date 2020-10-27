

<!-- Judul Header -->
<section class="content-header">
	<h1>
		Rekap Absen
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
			<div class="box box-success">
				<div class="box-body">
					<div class="pull-right">
						<a href="<?php echo base_url('all/admin_page'); ?>"  class="btn btn-sm btn-danger" >
						<span class="fa fa-mail-forward"></span> Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<!-- Content -->
   <div class="row">
		<div class="col-lg-6">
			<form class="form-horizontal" id="absenrekap" method="post" enctype="multipart/form-data" >
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="box box-success">
					<div class="box-body">
						<div class="form-group">
							<label class="control-label col-sm-3">Lembaga</label>
							<div class="col-sm-6">
								<select <?php if ($this->session->userdata('akseslembaga') == "T") {?>disabled="disabled"<?php }?> class="form-control select2" name="idlembaga" id="idlembaga_combo" style="width: 100%;">
									<?php
									$no = 1;
									foreach ($combolembaga as $row) {
										?>
									<option value="<?php echo $row->id_lembaga; ?>"><?php echo $row->nama_lembaga; ?></option>
									<?php
									$no++;}
									?>
									<?php if ($this->session->userdata('akseslembaga') == "Y") {?>
											<option value="all">SEMUA LEMBAGA</option>
									<?php }?>
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
							<label class="col-sm-3 control-label">Tanggal Awal</label>
							<div class="col-sm-6">
								<div class="input-group date">
								<input type="text"  name="tglperiode1" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="tglperiode1">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<?php echo form_error('tglperiode1', '<small class="text-danger pl-3">', '</small>'); ?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Akhir</label>
							<div class="col-sm-6">
								<div class="input-group date">
								<input type="text"  name="tglperiode2" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="tglperiode2">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<?php echo form_error('tglperiode2', '<small class="text-danger pl-3">', '</small>'); ?>
								</div>
							</div>
						</div>

					</div>	
					
					<div class="box-footer">
						<button onclick="reload_rekapabsendep()" id="submit" class="btn btn-sm btn-info" type="button"><i class="fa fa-search"></i> Cari</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-6">
			<div class="box box-success">
				<div class="box-body">
                    <div class="form-group">
							<label class="col-sm-12 control-label"><u>KETERANGAN</u></label>
                            
                    </div>
                    <div class="form-group">
							<label class="col-sm-1 control-label">A</label>
                            <label class="col-sm-1 control-label">:</label>
                            <label class="col-sm-10 control-label">Alpa</label>
                    </div>
                    <div class="form-group">
							<label class="col-sm-1 control-label">H</label>
                            <label class="col-sm-1 control-label">:</label>
                            <label class="col-sm-10 control-label">Hadir</label>
                    </div>
                    <div class="form-group">
							<label class="col-sm-1 control-label">HT</label>
                            <label class="col-sm-1 control-label">:</label>
                            <label class="col-sm-10 control-label">Hadir Terlambat</label>
                    </div>
					<div class="form-group">
							<label class="col-sm-1 control-label">S</label>
                            <label class="col-sm-1 control-label">:</label>
                            <label class="col-sm-10 control-label">Sakit</label>
                    </div>
                    <div class="form-group">
							<label class="col-sm-1 control-label">I</label>
                            <label class="col-sm-1 control-label">:</label>
                            <label class="col-sm-10 control-label">Ijin</label>
                    </div>
                    <div class="form-group">
							<label class="col-sm-1 control-label">C</label>
                            <label class="col-sm-1 control-label">:</label>
                            <label class="col-sm-10 control-label">Cuti</label>
                    </div>
                    <div class="form-group">
							<label class="col-sm-1 control-label">T</label>
                            <label class="col-sm-1 control-label">:</label>
                            <label class="col-sm-10 control-label">Tugas</label>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>




<!--DATA SHIFT-->
<div class="dataabsen" id="dataabsen"></div>

<?php
 function tgl_indo($date)
    {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $result =  $tgl . "/" .$bulan   ;
        //$result = $tgl."-".$bulan."-".$tahun;
        return ($result);
    }

	?>












