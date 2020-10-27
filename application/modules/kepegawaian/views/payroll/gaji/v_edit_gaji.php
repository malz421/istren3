	
<section class="content-header">
  <h1>
    Edit Gaji
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
        <form class="form-horizontal" method="post" action="<?php echo base_url().'kepegawaian/payroll/update_gaji'?>" enctype="multipart/form-data">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
          <div class="box">
            <div class="box-body">
              <div class="form-group">
                <label class="col-md-3 control-label">Periode</label>
                <div class="col-md-6">
                 <input type="hidden" name="id_teamplate" value="" class="form-control"readonly>
                  <input type="text" name="id_periode" value="<?=$detail_karyawan->nama_periode; ?>" class="form-control"readonly>
               </div>
             </div>
             <!-- <div class="form-group"> -->
              <!-- <label class="col-md-3 control-label">NIP</label> -->
              <!-- <div class="col-md-6"> -->
                <input type="hidden" name="id_karyawan" value="">
                <input type="hidden" name="nip" value="<?=$detail_karyawan->nip_karyawan; ?>" class="form-control"readonly>
              <!-- </div>
            </div> -->

            <div class="form-group">
              <label class="col-md-3 control-label">Nama Pegawai</label>
              <div class="col-md-6">
                <input type="text" name="nip" value="<?=$detail_karyawan->nama_karyawan; ?>" class="form-control">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3">Lembaga</label>
              <div class="col-sm-6">
                <select class="form-control select2" name="id_lembaga" id="idlembaga" readonly>
                  <option value="<?=$detail_karyawan->id_lembaga; ?>"><?=$detail_karyawan->nama_lembaga; ?></option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label">Unit Kerja</label>
              <div class="col-md-6">
                <select class="form-control select2" name="id_unit_kerja" readonly id="idunitkerja" style="width: 100%;" required>
                  <option value="<?=$detail_karyawan->id_unit_kerja; ?>"><?=$detail_karyawan->nama_unit_kerja; ?></option>
                </select>
              </div>
            </div>

            <?php  $kode_kategori=''; ?>
            <?php foreach ($datakategori as $key): ?>

              <?php if ($kode_kategori!=$key->id_group_kategori_komponen): ?>
                <?php
               $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji = payroll_detail_transaksi.id_komponen_gaji');  
                $this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
                $this->db->where('payroll_transaksi.status',0);
                $this->db->where('payroll_transaksi.id_karyawan',$detail_karyawan->id_karyawan);
                $this->db->where('payroll_detail_transaksi.id_group_kategori_komponen',$key->id_group_kategori_komponen);
                $Komponen=$this->db->get('payroll_detail_transaksi')->result();
                // // var_dump($Komponen); die();
                ?>
                <div class="form-group col-md-7">
                  <div class="box box-solid box-primary" style="margin-left: 215px;">
                    <div class="box-header">
                      <h3 class="box-title"><?=$key->nama_kategori; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <?php foreach ($Komponen as $key2): ?>
                      <div class="box-body">
                       <!-- <label class="col-md-2 control-label">Komponen</label> -->
                       <div class="col-md-6">
                        <input type="text" name="#" value="<?=$key2->nama_kategori_komponen; ?>" class="form-control" disabled>
                      </div>

                      <div class="col-sm-6">
                        <input type="text" name="id_detail_transaksi[]" value="<?=$key2->id_detail_transaksi; ?>" hidden>
                        <input type="text" placeholder="Masukan Jumlah Gaji" id="diskon2" class="form-control" value="<?=number_format($key2->jml_gaji,0,",","."); ?>" name="jml_gaji[]" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
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

  