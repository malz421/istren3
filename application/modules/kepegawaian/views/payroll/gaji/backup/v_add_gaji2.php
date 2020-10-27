
<section class="content-header">
  <h1>
    Tambah Gaji
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
        <form class="form-horizontal" method="post" action="<?php echo base_url().'kepegawaian/payroll/add_gaji'?>" enctype="multipart/form-data">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
          <div class="box">
            <div class="box-body">
              <div class="form-group">
                <label class="col-md-3 control-label">Periode</label>
                <div class="col-md-6">
                 <input type="hidden" name="id_teamplate" value="<?=$id_teamplate; ?>" class="form-control"readonly>
                 <input type="text" name="#" value="<?=$dataperiode->nama_periode; ?>" class="form-control"readonly>
                  <input type="hidden" name="id_periode" value="<?=$dataperiode->id_periode; ?>" class="form-control"readonly>
               </div>
             </div>
             <div class="form-group">
              <label class="col-md-3 control-label">NIP</label>
              <div class="col-md-6">
                <input type="hidden" name="id_karyawan" value="<?=$datapegawai->id_karyawan; ?>">
                <input type="text" name="nip" value="<?=$datapegawai->nip_karyawan; ?>" class="form-control"readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Nama Pegawai</label>
              <div class="col-md-6">
                <input type="text" name="nip" value="<?=$datapegawai->nama_karyawan; ?>" class="form-control"readonly>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3">Lembaga</label>
              <div class="col-sm-6">
                <select class="form-control select2" name="id_lembaga" id="idlembaga" readonly>
                  <option value="<?php echo $datapegawai->id_lembaga; ?>"><?php echo $datapegawai->nama_lembaga; ?></option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Unit Kerja</label>
              <div class="col-md-6">
                <select class="form-control select2" name="id_unit_kerja" readonly id="idunitkerja" style="width: 100%;" required>
                  <option value="<?php echo $datapegawai->id_unit_kerja; ?>"><?php echo $datapegawai->nama_unit_kerja; ?></option>
                </select>
              </div>
            </div>

            <?php  $kode_kategori=''; ?>
            <?php foreach ($datakategori as $key): ?>

              <?php if ($kode_kategori!=$key->id_group_kategori_komponen): ?>
                <?php
                $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji= payroll_detail_template.id_komponen_gaji');   
                $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen= payroll_detail_template.id_group_kategori_komponen');
                $this->db->where('payroll_detail_template.id_teamplate',$id_teamplate);
                $this->db->where('payroll_detail_template.id_group_kategori_komponen',$key->id_group_kategori_komponen);
                $Komponen=$this->db->get('payroll_detail_template')->result();
                ?>
                <div class="form-group col-md-7">
                  <div class="box box-solid box-primary" style="margin-left: 335px;">
                    <div class="box-header">
                      <h3 class="box-title"><?=$key->nama_kategori; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <?php foreach ($Komponen as $key2): ?>
                      <div class="box-body">
                       <!-- <label class="col-md-2 control-label">Komponen</label> -->
                       <div class="col-md-6">
                         <input type="hidden" name="id_detail_template[]"  value="<?=$key2->id_detail_template; ?>" class="form-control">
                         <input type="hidden" name="type[]"  value="<?=$key2->type; ?>" class="form-control">
                          <input type="hidden" name="id_group_kategori_komponen[]"  value="<?=$key2->id_group_kategori_komponen; ?>" class="form-control">
                           <input type="hidden" name="id_komponen_gaji[]"  value="<?=$key2->id_komponen_gaji; ?>" class="form-control">
                       <!--  <input type="text" name="id_detail_template[]"  value="<?=$key2->id_detail_template; ?>" class="form-control"> -->
                        <input type="text" name="#" value="<?=$key2->nama_kategori_komponen; ?>" class="form-control" disabled>
                      </div>

                      <div class="col-sm-6">
                        <input type="text" placeholder="Masukan Jumlah Gaji" id="diskon2" class="form-control" value="0" name="jml_gaji[]" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                        <small class="text-danger pl-3">Nominal</small>
                      </div>
                    </div>
                  <?php endforeach ?>
                  <!-- /.box-body -->
                </div>
              </div>
            <?php endif ?>

            <?php $kode_kategori=$key->id_group_kategori_komponen; ?>
          <?php endforeach ?>
          <div class="form-group col-md-7" style="float: right;">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-6">
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

  