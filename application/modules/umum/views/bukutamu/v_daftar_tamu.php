

<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		DAFTAR TAMU
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
					<a class="btn btn-sm btn-success" href="<?=base_url('umum/Formulir') ?>">
					<span class="fa fa-plus"></span> Tamu Baru</a>
						<a href="<?php echo base_url('umum/Daftartamu'); ?>" class="btn btn-sm btn-info">
							<span class="fa fa-refresh"></span> Refresh</a>
							  <button onclick="goBack()" class="btn btn-sm btn-danger"><span class="fa fa-mail-forward"></span> Kembali</button>
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
								<table class="table table-bordered table-striped" style="font-size:14px;" id="example2">
									<thead>
										<tr>
											<th>No</th>
											<!-- <th>Foto</th> -->
											<th>Nama</th>
											<!-- <th>Tujuan</th> -->
											<th>Instansi</th>
											<!-- <th>Alamat</th>
											<th>Tanda Tangan</th> -->
											<th>Tanggal Bertamu</th>
											<!-- <th>No HP</th> -->

											<th style="text-align: center;">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										foreach ($datatamu as $key => $row) {
											$id=$row->id_tamu;
											$no++;
											?>
											<tr>
												<td><?=$no; ?></td>
												<!-- <td style="max-width: 10px"><img style="max-width: 100%;" src="<?=$key->image; ?>"></td> -->
												<td><a href="#modal-success<?php echo $id ?>" data-toggle="modal"><?php echo $row->nama_tamu; ?></a></td>
												<!-- <td><?php echo $key->tujuan_tamu; ?></td> -->
												<td><?php echo $row->instansi_tamu; ?></td>
												<!-- <td><?php echo $key->alamat_tamu; ?></td> -->
												
												<!-- <td style="max-width: 10px"><img style="max-width: 100%;" src="<?=$key->tanda_tangan; ?>"> -->
												<td><?php echo $row->tgl_bertamu; ?></td>
												<!-- <td><a href="https://api.whatsapp.com/send?phone='<?=$key->no_hp_tamu; ?>'&amp;" target="_blank" class="fa fa-whatsapp btn btn-lg btn-success"> Kirim Pesan</a></td> -->
												<!-- <td><?php echo $key->no_hp_tamu; ?><button style=" margin-left: 10px;" class="btn btn-sm btn-success">Kirim Pesan  <img style="height: 18px; width: 18px;" src="<?=base_url('assets/images/whatsapp.svg') ?>"></button></td> -->

												<td>
													<a href="<?=base_url('umum/daftartamu/edit_tamu/') ?><?=$row->id_tamu; ?>">
														<span class="btn btn-warning btn-xs">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<a href="<?=base_url('umum/daftartamu/hapus_tamu/'.$row->id_tamu); ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus"  data-toggle="tooltip" title="Delete">
															<i class="fa fa-trash"></i>
													</a>
													<a href="https://api.whatsapp.com/send?phone='<?=$row->no_hp_tamu; ?>'&amp;" target="_blank" class="fa fa-whatsapp btn btn-xs btn-success"> Kirim Pesan</a>
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
				</div>
			</section>

		<!-- /.modal -->
<?php 
foreach ($datatamu as $key) {
$id2=$key->id_tamu;

 ?>

        <div class="modal modal-success fade" id="modal-success<?php echo $id2; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Data Tamu</h4>
              </div>
              <div class="modal-body">
              	<center>
              		<b style="font-size: 40px;"><?=$key->nama_tamu; ?></b>
              		<br><br>
              <img style="max-width: 100%;" src="<?=$key->image; ?>">
              
              <br>
              <br>
              
         		<p>No Hp    :<?=$key->no_hp_tamu; ?></p>
              	<p>Instansi :<?=$key->instansi_tamu; ?></p>
         		<p>Alamat   :<?=$key->alamat_tamu; ?></p>
         		<p>Ketemu Dengan   :<?=$key->nama_karyawan; ?></p>
         		<p>Tujuan   :<?=$key->tujuan_tamu; ?></p>
         		<p>Tanggal  :<?=$key->tgl_bertamu; ?></p>
         		<br>
         		<img style="width: 500px;" src="<?=$key->tanda_tangan; ?>">
         		</center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-outline">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php } ?>