
<!-- Judul Header -->
<section class="content-header">
	<h1>
		Detail Data Karyawan
	</h1>
</section>

 <div class="preloader">
      <div class="loading">
        <img src="<?php echo base_url('assets/images/pageloading.gif'); ?>" width="80">
        <p>Harap Tunggu</p>
      </div>
  </div>
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
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-user text-green"></i> Profile</a></li>
              <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-users text-blue"></i> Keluarga</a></li>
              <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-university text-yellow"></i> Pendidikan</a></li>
              <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-indent text-green"></i> Jabatan</a></li>
              <li><a href="#tab_5" data-toggle="tab"><i class="fa fa-suitcase text-red" ></i> Riwayat Kerja</a></li>
              <li><a href="#tab_6" data-toggle="tab"><i class="fa fa-list-alt text-orange"></i> Diklat</a></li>
              <li><a href="#tab_7" data-toggle="tab"><i class="fa fa-list text-purple"></i> Seminar</a></li>
              <li><a href="#tab_8" data-toggle="tab"><i class="fa fa-clock-o text-yellow"></i> Presensi</a></li>
              <li><a href="#tab_9" data-toggle="tab"><i class="fa fa-file-text-o text-red"></i> Dokumen</a></li>
            </ul>
            <div class="tab-content">
              <?php foreach ($datakaryawan->result() as $a) {
                    $idkaryawan = $a->id_karyawan;
                    $nipkaryawan = $a->nip_karyawan;
                    ?>
                  <div class="tab-pane active" id="tab_1">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/karyawan/update_karyawan' ?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="box">
                                <div class="box-body">
                                  <div class="pull_center"> <a href="<?php echo base_url('kepegawaian/karyawan'); ?>"  class="btn btn-sm btn-info" >
                                  <span class="fa fa-print"></span> Print</a></div>
                                </div>
                              </div>
                            </div>
                          </div>

                        <input type="hidden" name="idkaryawan" value="<?php echo $a->id_karyawan; ?>" class="form-control"/>
                        <input type="hidden" name="nipkaryawan" value="<?php echo $a->nip_karyawan; ?>" class="form-control"/>

                        <div class="row">
                          <div class="container">

                            <div class="form-group">
                              <label class="col-md-3 control-label">NIP</label>
                              <div class="col-md-6">
                                <input type="text" name="nipkaryawan" maxlength="24" class="form-control" value="<?php echo $a->nip_karyawan; ?>" placeholder="Nomor induk pegawai otomatis"/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-sm-3">Lembaga</label>
                              <div class="col-sm-6">
                                <select <?php if ($this->session->userdata('akseslembaga') == "T") {?>disabled="disabled"<?php }?> class="form-control select2" name="idlembaga" id="idlembaga" style="width: 100%;">
                                  <?php
                                  $no = 1;
                                      foreach ($combolembaga as $row) {
                                          ?>
                                                                                                                              <option value="<?php echo $row->id_lembaga; ?>" <?php if ($row->id_lembaga == $a->id_lembaga) {
                                              echo "selected=selected";
                                          }
                                          ?> ><?php echo $row->nama_lembaga; ?></option>
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
                                      foreach ($combounitkerja as $row) {
                                          ?>
                                                                          <option value="<?php echo $row->id_unit_kerja; ?>" <?php if ($row->id_unit_kerja == $a->id_unit_kerja) {
                                              echo "selected=selected";
                                          }
                                          ?>><?php echo $row->nama_unit_kerja; ?></option>
                                                                                                                          <?php
                                  $no++;}
                                      ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">NIK</label>
                              <div class="col-md-6">
                                <input type="number" name="nikkaryawan" maxlength="24"  value="<?php echo $a->nik_karyawan; ?>" class="form-control" />
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">Nama Karyawan</label>

                              <div class="col-sm-1">
                                <input type="text" name="gelardepan" maxlength="64"  value="<?php echo $a->gelar_awal; ?>" class="form-control" />
                                <small class="text-danger pl-3">Gelar Depan</small>
                              </div>

                              <div class="col-md-6">
                                <input type="text" name="namakaryawan" maxlength="64" value="<?php echo $a->nama_karyawan; ?>" class="form-control" />
                                <?php echo form_error('namakaryawan', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>

                              <div class="col-sm-1">
                                <input type="text" name="gelarbelakang" maxlength="64" value="<?php echo $a->gelar_akhir; ?>" class="form-control" />
                                <small class="text-danger pl-3">Gelar Belakang</small>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">Nama Panggilan</label>
                              <div class="col-md-6">
                                <input type="text" name="namapanggilan" maxlength="24" value="<?php echo $a->panggilan; ?>" class="form-control" />
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">Tempat, Tanggal Lahir</label>
                              <div class="col-md-3">
                                <input type="text" name="tempatlahir" maxlength="64"  value="<?php echo $a->tempat_lahir; ?>" class="form-control"/>
                                <?php echo form_error('tempatlahir', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                              <div class="col-md-3">
                                <div class="input-group date">
                                  <input type="text"  name="tgllahir" value="<?php echo rubah_tanggal($a->tanggal_lahir); ?>" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicker">
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
                                  <option value="l" <?php if ($a->jenis_kelamin == 'l') {
                                        echo "selected=selected";
                                    }
                                    ?>>Laki-laki
                                                                                                              <option value="p" <?php if ($a->jenis_kelamin == 'p') {
                                        echo "selected=selected";
                                    }
                                    ?>>Perempuan
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3">Golongan Darah</label>
                              <div class="col-md-6">
                                <select class="form-control select2" name="golongandarah" id="golongandarah" style="width: 100%;" required>
                                <?php
                                $no = 1;
                                    foreach ($combogoldarah as $row) {
                                        ?>
                                                                                                            <option value="<?php echo $row->goldarah; ?>" <?php if ($row->goldarah == $a->golongan_darah) {
                                            echo "selected=selected";
                                        }
                                        ?>><?php echo $row->goldarah; ?></option>
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
                                        foreach ($combonikah as $row) {
                                            ?>
                                                                                                                <option value="<?php echo $row->id_sts_nikah; ?>"<?php if ($row->id_sts_nikah == $a->status_pernikahan) {
                                                echo "selected=selected";
                                            }
                                            ?> ><?php echo $row->ket_sts_nikah; ?></option>
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
                                      foreach ($combostskaryawan as $row) {
                                          ?>
                                                                                                                            <option value="<?php echo $row->id_sts_karyawan; ?>" <?php if ($row->id_sts_karyawan == $a->id_sts_karyawan) {
                                              echo "selected=selected";
                                          }
                                          ?> ><?php echo $row->ket_sts_karyawan; ?></option>
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
                                        foreach ($comboststinggal as $row) {
                                            ?>
                                                                                                                    <option value="<?php echo $row->id_sts_tinggal; ?>" <?php if ($row->id_sts_tinggal == $a->id_tinggal) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $row->ket_sts_tinggal; ?></option>
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
                                        foreach ($combostskerja as $row) {
                                            ?>
                                                                                                                        <option value="<?php echo $row->id_sts_karyaaktif; ?>"<?php if ($row->id_sts_karyaaktif == $a->id_sts_aktif) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $row->ket_sts_karyaaktif; ?></option>
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
                                <input type="text"  name="tglmulaikerja" value="<?php echo rubah_tanggal($a->tgl_berkerja); ?>" class="form-control pull-right" data-date-format="dd-mm-yyyy" id="datepicker2">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <?php echo form_error('tglmulaikerja', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">Alamat</label>
                              <div class="col-md-6">
                                <textarea name="alamatkaryawan" maxlength="255" class="form-control"><?php echo $a->alamat_karyawan; ?></textarea>
                                <?php echo form_error('alamatkaryawan', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">No. Hp</label>
                              <div class="col-md-6">
                                <input type="text" name="notlpkaryawan" maxlength="12" value="<?php echo $a->no_hp; ?>" class="form-control" />
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">Email</label>
                              <div class="col-md-6">
                                <input type="text" name="emailkaryawan" maxlength="64" value="<?php echo $a->email; ?>"  class="form-control" />
                                <?php echo form_error('emailkaryawan', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">Id NFC</label>
                              <div class="col-md-6">
                                <input type="text" name="nfc" maxlength="64" value="<?php echo $a->nfc; ?>"  class="form-control" />

                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-3 control-label">Photo Profile</label>
                              <div class="col-md-6">
                              <?php if (isset($a->photo_profile)) {
                                  ?>
                                                    <img id="blah" name="photo" height="150px" width="150px" alt="" src="<?php echo base_url('storage/photo/karyawan/' . $a->photo_profile); ?>"><br>
                                                    <?php
                                  } else {
                                          ?>
                                                                                      <img id="blah" name="photo" height="150px" width="150px" alt="" src="<?php echo base_url('storage/photo/karyawan/avatar.jpg'); ?>"><br>
                                                                                      <?php
                                  }
                                      ?>

                                <label style="width:150px;border-radius: 0px;margin-bottom:0px" class="btn btn-info btn-xs">Browse Foto
                                  <input enctype="multipart/form-data" type="file" style="width:150px;display:none;" id="image" name="filephoto" accept=".jpg,.png,image/*" capture onchange="readURL()">
                                </label><br>
                                <span style="color:red;font-size:14px;text-align:center"><i>Limit size (100 KB)</i></span>
                              </div>
                            </div>

                          </div>

                          <div class="modal-footer">
                              <a class="btn btn-danger" href="<?php echo base_url('kepegawaian/karyawan'); ?>" id="Keluar"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> Batal</a>
                          </div>
                        </div>
                    </form>
                  </div>

            <!-- /.tab-pane1 -->

                  <!-- TAB KELUARGA -->
                  <div class="tab-pane" id="tab_2">
                    <form>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="box">
                              <div class="box-body">
                                <div class="pull_center">
                                <input type="hidden" id="idkaryawan" value = <?=$idkaryawan?>>
                                <input type="hidden" id="nipkaryawan" value = <?=$nipkaryawan?>>
                                <a href="#"  class="btn btn-sm btn-info" >
                                <span class="fa fa-print"></span> Print</a>
                                <a onclick="reloadkeluarga_ajax()" class="btn btn-sm btn-default">
                                <span class="fa fa-refresh"></span> Reload</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">

                          <div class= "table-responsive" style="border: 0">
                            <div class="box">
                              <div class="box-body">
                                <table class="table table-bordered table-striped" style="font-size:14px;" id="keluarga">
                                  <thead>
                                  <tr>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tgl Lahir</th>
                                    <th>Usia</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Hubungan</th>
                                    <th>Pendidikan</th>
                                    <th>Perkerjaan</th>
                                  </tr>
                                  </thead>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                    </form>
                  </div>
                    <!--/.tab-pane2 -->
                  <!--TAB PENDIDIKAN -->
                  <div class="tab-pane" id="tab_3">
                    <form>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="box">
                            <div class="box-body">
                              <div class="pull_center">
                                <input type="hidden" id="idkaryawan" value = <?=$idkaryawan?>>
                                <input type="hidden" id="nipkaryawan" value = <?=$nipkaryawan?>>
                                <a href="<?php echo base_url('kepegawaian/jabatan/print/' . $idkaryawan . '/' . $nipkaryawan); ?>"  class="btn btn-sm btn-info" >
                                <span class="fa fa-print"></span> Print</a>
                                <a onclick="reloadpendidikan_ajax()" class="btn btn-sm btn-default">
                                <span class="fa fa-refresh"></span> Reload</a>
                                </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="row">
                        <div class="form-group">
                          <div class="col-xs-12">
                            <div class="box">
                              <div class="box-body">
                                <table class="table table-bordered table-striped" style="font-size:14px;" id="pendidikan">
                                  <thead>
                                    <tr>
                                      <th>Aksi</th>
                                      <th>No</th>
                                      <th>Tingkat Pendidikan</th>
                                      <th>Jurusan</th>
                                      <th>Nama Perguruan Tinggi/ Sekolah </th>
                                      <th>Tahun Masuk</th>
                                      <th>Tahun Lulusan </th>
                                      <th>Ket Lulusan</th>
                                      <!--TAB PENDIDIKAN -->
                                    </tr>
                                  </thead>
                                  </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                    <!--TAB JABATAN -->

                    <div class="tab-pane" id="tab_4">
                      <form>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="box">
                              <div class="box-body">
                              <input type="hidden" id="idkaryawan" value = <?=$idkaryawan?>>
                                <input type="hidden" id="nipkaryawan" value = <?=$nipkaryawan?>>
                                <div class="pull_center"> 
                                <a href="<?php echo base_url('kepegawaian/jabatan/print/' . $idkaryawan . '/' . $nipkaryawan); ?>"  class="btn btn-sm btn-info" >
                                <span class="fa fa-print"></span> Print</a>
                                <a onclick="reloadjabatan_ajax()" class="btn btn-sm btn-default">
                                <span class="fa fa-refresh"></span> Reload</a>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="form-group">
                            <div class="col-xs-12">
                              <div class="box">
                                <div class="box-body">
                                  <table class="table table-bordered table-striped" style="font-size:14px;" id="jabatan">
                                    <thead>
                                      <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Jabatan</th>
                                        <th>No SK</th>
                                        <th>Tgl SK</th>
                                        <th>TMT Jabatan</th>
                                      </tr>
                                    </thead>                            
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="tab_5">
                      <form>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="box">
                              <div class="box-body">
                              <input type="hidden" id="idkaryawan" value = <?=$idkaryawan?>>
                                <input type="hidden" id="nipkaryawan" value = <?=$nipkaryawan?>>
                                <div class="pull_center"> 
                                <a href="<?php echo base_url('kepegawaian/riwayat/print'); ?>"  class="btn btn-sm btn-info" >
                                <span class="fa fa-print"></span> Print</a>
                                <a onclick="reloadriwayat_ajax()" class="btn btn-sm btn-default">
                                <span class="fa fa-refresh"></span> Reload</a>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="form-group">
                            <div class="col-xs-12">
                              <div class="box">
                                <div class="box-body">
                                  <table class="table table-bordered table-striped" style="font-size:14px;" id="riwayat">
                                    <thead>
                                      <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Jabatan</th>
                                        <th>Gaji</th>
                                        <th>Tahun Masuk</th>
                                        <th>Tahun Keluar</th>
                                      </tr>
                                    </thead>                            
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="tab_6">
                      <form>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="box">
                              <div class="box-body">
                              <input type="hidden" id="idkaryawan" value = <?=$idkaryawan?>>
                                <input type="hidden" id="nipkaryawan" value = <?=$nipkaryawan?>>
                                <div class="pull_center"> 
                                <a href="<?php echo base_url('kepegawaian/diklat/print'); ?>"  class="btn btn-sm btn-info" >
                                <span class="fa fa-print"></span> Print</a>
                                <a onclick="reloaddiklat_ajax()" class="btn btn-sm btn-default">
                                <span class="fa fa-refresh"></span> Reload</a>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="form-group">
                            <div class="col-xs-12">
                              <div class="box">
                                <div class="box-body">
                                  <table class="table table-bordered table-striped" style="font-size:14px;" id="diklat">
                                    <thead>
                                      <tr>
                                      <th>Aksi</th>
                                        <th>No</th>
                                        <th>Nama Diklat</th>
                                        <th>Penyelengara Diklat</th>
                                        <th>Tempat Diklat</th>
                                        <th>Tahun Diklat</th>
                                      </tr>
                                    </thead>                            
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                     <div class="tab-pane" id="tab_7">
                      <form>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="box">
                              <div class="box-body">
                              <input type="hidden" id="idkaryawan" value = <?=$idkaryawan?>>
                                <input type="hidden" id="nipkaryawan" value = <?=$nipkaryawan?>>
                                <div class="pull_center"> 
                                <a href="<?php echo base_url('kepegawaian/seminar/print'); ?>"  class="btn btn-sm btn-info" >
                                <span class="fa fa-print"></span> Print</a>
                                <a onclick="reloadseminar_ajax()" class="btn btn-sm btn-default">
                                <span class="fa fa-refresh"></span> Reload</a>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="form-group">
                            <div class="col-xs-12">
                              <div class="box">
                                <div class="box-body">
                                  <table class="table table-bordered table-striped" style="font-size:14px;" id="seminar">
                                    <thead>
                                      <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Nama Seminar/Training</th>
                                        <th>Penyelengara</th>
                                        <th>Tempat</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Selesai</th>
                                      </tr>
                                    </thead>                            
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="tab_8">
                      <form>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="box">
                              <div class="box-body">
                                <div>
                                  <a href="<?php echo base_url('kepegawaian/karyawan/tambah_keluarga/' . $idkaryawan); ?>" >
                                  <a href="<?php echo base_url('kepegawaian/karyawan'); ?>"  class="btn btn-sm btn-info" >
                                  <span class="fa fa-print"></span> Print</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                              <div class="col-7 col-lg-8">
                                <div class="box box-primary">
                                  <div class="box-body no-padding">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar" class="fc fc-unthemed fc-ltr"> </div>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-5 col-lg-4">
                                <div class="box box-primary">
                                  <div class="box-body no-padding">
                                      <div class="container">
                                        <div class="form-group">
                                          <label class="control-label col-sm">Akum Waktu Terlambat</label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(menit)</label>
                                        </div>

                                        <div class="form-group">
                                          <label class="control-label col-sm">Akum Waktu Terlambat</label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(menit)</label>
                                        </div>

                                        <div class="form-group">
                                          <label class="control-label col-sm">Alpa </label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(hari)</label>
                                        </div>

                                        <div class="form-group">
                                          <label class="control-label col-sm">Sakit </label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(hari)</label>
                                        </div>

                                        <div class="form-group">
                                          <label class="control-label col-sm">Ijin </label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(hari)</label>
                                        </div>
                                      </div>
                                    <div class="box-footer">
                                        <a id="exprekapabsenkaryawan" href="<?php echo base_url('kepegawaian/laporanabsen/exp_rekap_absensi_karyawan'); ?>" class="btn btn-sm btn-success">
                                        <span class="fa fa-file-excel-o"></span> Export Absensi karyawan</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                        

                      </form>
                      </div>

                      <div class="tab-pane" id="tab_9">
                      <form>
                       <input type="hidden" id="idkaryawan" value = "<?= $idkaryawan ?>">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="box">
                              <div class="box-body">
                                <div>
                                  <a href="<?php echo base_url('kepegawaian/karyawan/tambah_keluarga/' . $idkaryawan); ?>" >
                                  <a href="<?php echo base_url('kepegawaian/karyawan'); ?>"  class="btn btn-sm btn-info" >
                                  <span class="fa fa-print"></span> Print</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                              <div class="col-7 col-lg-8">
                                <div class="box box-primary">
                                  <div class="box-body no-padding">
                                   <!-- foto dokumen -->
                                   <input style="display: none;" type="text" name="id_karyawan" id="id_karyawan" value="<?=$id_karyawan; ?>">
                                   <div class="dropzone">

                                    <div class="dz-message">
                                     <h3> Klik atau Drop gambar disini</h3>
                                   </div>

                                 </div>
                                  </div>
                                </div>
                              </div>
                             


                              <div class="col-5 col-lg-4">
                                <div class="box box-primary">
                                  <div class="box-body no-padding">
                                      <div class="box-header">
                                          <span class="text-center"><h3> Informasi Detail</h3></span>
                                        </div>
                                    
                                      <div class="container">
                                       
                                        <div class="form-group">
                                          <label class="control-label col-sm">Akum Waktu Terlambat</label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(menit)</label>
                                        </div>

                                        <div class="form-group">
                                          <label class="control-label col-sm">Akum Waktu Terlambat</label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(menit)</label>
                                        </div>

                                        <div class="form-group">
                                          <label class="control-label col-sm">Alpa </label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(hari)</label>
                                        </div>

                                        <div class="form-group">
                                          <label class="control-label col-sm">Sakit </label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(hari)</label>
                                        </div>

                                        <div class="form-group">
                                          <label class="control-label col-sm">Ijin </label>
                                          <label class="control-label col-sm">:</label>
                                          <label class="control-label col-sm">(hari)</label>
                                        </div>
                                      </div>
                                    <div class="box-footer">
                                        <a id="exprekapabsenkaryawan" href="<?php echo base_url('kepegawaian/laporanabsen/exp_rekap_absensi_karyawan'); ?>" class="btn btn-sm btn-success">
                                        <span class="fa fa-file-excel-o"></span> Export Absensi karyawan</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>

                      </form>
                      </div>
                    
                    



            <!-- /.tab-pane -->
            
        


<?php
}
?>
            <!-- /.tab-content -->
                </div>
             </div>
          </div>
          <!-- nav-tabs-custom -->
        </div>
</section>



<!--END MODAL-->
<!-- /.content -->

<script src="<?=base_url()?>assets/dist/js/app/karyawan/keluargadetail.js"></script>
<script src="<?=base_url()?>assets/dist/js/app/karyawan/pendidikandetail.js"></script>
<script src="<?=base_url()?>assets/dist/js/app/karyawan/jabatandetail.js"></script>
<script src="<?=base_url()?>assets/dist/js/app/karyawan/riwayatdetail.js"></script>
<script src="<?=base_url()?>assets/dist/js/app/karyawan/diklatdetail.js"></script>
<script src="<?=base_url()?>assets/dist/js/app/karyawan/seminardetail.js"></script>



<!-- ====== MODAL ADD KELUARGA == -->
<div class="modal fade " id="modalkeluarga" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog mo" role="dialog">
		<div class="modal-content">

		</div>
	</div>
</div>
<!-- END MODAL ADD --->

<!-- ====== MODAL ADD Pendidikan == -->
<div class="modal fade" id="modalpendidikan" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="dialog">
		<div class="modal-content">

		</div>
	</div>
</div>
<!-- END MODAL ADD --->

<!-- ====== MODAL ADD Jabatan == -->
<div class="modal fade" id="modaljabatan" aria-labelledby="modaljabatan" aria-hidden="true">
	 <div class="modal-dialog" role="dialog">
		<div class="modal-content">

		</div>
  </div>
	
</div>
<!-- END MODAL ADD --->


<!-- ====== MODAL ADD Riwayat == -->
<div class="modal fade" id="modalriwayat" aria-labelledby="modalriwayat" aria-hidden="true">
	 <div class="modal-dialog" role="dialog">
		<div class="modal-content">

		</div>
  </div>
	
</div>
<!-- END MODAL ADD --->

<!-- ====== MODAL ADD Diklat == -->
<div class="modal fade" id="modaldiklat" aria-labelledby="modaldiklat" aria-hidden="true">
	 <div class="modal-dialog" role="dialog">
		<div class="modal-content">

		</div>
  </div>
	
</div>
<!-- END MODAL ADD --->

<!-- ====== MODAL ADD Seminar == -->
<div class="modal fade" id="modalseminar" aria-labelledby="modalseminar" aria-hidden="true">
	 <div class="modal-dialog" role="dialog">
    <div class="modal-content container-fluid">

		</div>
    </div>
  </div>
	
</div>
<!-- END MODAL ADD --->


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

<!-- END MODAL HAPUS -->


<!-- dropzone -->

<script type="text/javascript">
Dropzone.autoDiscover = false;

var id_karyawan=$('#id_karyawan').val();
var foto_upload= new Dropzone(".dropzone",{
sending: function (file, xhr, formData) {
    formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
},
url: "<?php echo base_url('kepegawaian/karyawan/proses_upload') ?>",
params: {'idkaryawan':id_karyawan},
maxFilesize: 2,
method:"post",
acceptedFiles:"image/*",
paramName:"userfile",
dictInvalidFileType:"Type file ini tidak dizinkan",
addRemoveLinks:true,
});


//Event ketika Memulai mengupload
foto_upload.on("sending",function(a,b,c){
  a.token=Math.random();
  c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
});


//Event ketika foto dihapus
foto_upload.on("removedfile",function(a){
  var token=a.token;
  $.ajax({
    type:"post",
    data:{token:token},
    url:"<?php echo base_url('index.php/upload/remove_foto') ?>",
    cache:false,
    dataType: 'json',
    success: function(){
      console.log("Foto terhapus");
    },
    error: function(){
      console.log("Error");

    }
  });
});
</script>


