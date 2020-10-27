<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
<?php if ($this->session->flashdata('flash')): ?> 

<?php endif ;?>

<div class="flash-data2" data-flashdata2="<?=$this->session->flashdata('flash2');?>"></div>
<?php if ($this->session->flashdata('flash2')): ?> 

<?php endif ;?>
<!-- Judul Header -->
<section class="content-header">
	<h1>
		List Gaji
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
					<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal">
						<span class="fa fa-plus"></span> Tambah Gaji</a>
						<a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#Modal_generate_perunit">
						<span class="fa fa-plus"></span> Generate Gaji Perunit</a>
						<a href="<?php echo base_url('kepegawaian/Payroll/periode_penggajian'); ?>" class="btn btn-sm btn-info">
							<span class="fa fa-refresh"></span> Refresh</a>
							<button id="btn_kembali" class="btn btn-sm btn-danger">
								<span class="fa fa-mail-forward"></span> Kembali</button>
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
								<form method="post" action="<?php echo base_url('kepegawaian/payroll/pengambilan_gaji') ?>" id="form-bayar">
									<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
									<div class="text-left">
										<a href="#" class="btn btn btn-success" id="btn-delete">
											<i class="fa fa-money"></i>  Bayar Pegawai
										</a>
									</div>
								<table class="table table-bordered table-striped" style="font-size:14px;" id="example2">
									<thead>
										<tr>
											<th class="text-center">
												<input type="checkbox" id="check-all">
											</th>
											<th>Aksi</th>
											<th>Nip</th>
											<th>Nama Karyawan</th>
											<th>Unit</th>
											<th>Teamplate</th>
											<th>Periode</th>
											<th>Pendapatan</th>
											<th>Potongan</th>
											<th>Status</th>
											<th>Tanggal</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; ?>
									<?php foreach ($datagaji as $key): ?>
										<?php 
											$id = $key->id_karyawan;
											$no++;
										 ?>
										<tr>
											<td><input type='checkbox' class='check-item' name='id_karyawan[]' value='<?=$key->id_karyawan; ?>'></td>
											<td>
												<div class="text-center">
													<!-- jika sudah dibayarkan maka tidak bisa di edit -->
													<?php if ($key->status == 0): ?>
													<a href="<?=base_url('kepegawaian/payroll/edit_gaji/'); ?><?=$key->id_karyawan; ?>/<?=$key->id_teamplate; ?>"  title="Edit">
														<span class="btn btn-warning btn-xs">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<?php endif ?>

													<a href="<?=base_url('kepegawaian/payroll/hapus_gaji/'.$key->id_karyawan); ?>" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus"  data-toggle="tooltip" title="Delete">
														<i class="fa fa-trash"></i>
													</a>
													<a href="#" class="btn btn-xs btn-info" data-toggle="modal" data-target="#detail_gaji<?php echo $id ?>">
														<i class="fa fa-eye"></i>
													</a>
												</div>
											</td>
										<td><?=$key->nip_karyawan; ?></td>
										<td><?=$key->nama_karyawan; ?></td>
										<td><?=$key->nama_unit_kerja; ?></td>
										<td><?=$key->nama_teamplate; ?></td>
										<td><?=$key->nama_periode; ?></td>
										<td>
										<!-- Pendapatan -->
										<?php 
											$this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
											$this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
											$this->db->where('payroll_detail_transaksi.type','Penambahan');
											$this->db->where('payroll_transaksi.id_teamplate',$key->id_teamplate);
											$this->db->where('payroll_transaksi.id_karyawan',$key->id_karyawan);
											$this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'gaji');
											$ok=$this->db->get('payroll_detail_transaksi')->result();
										 ?>
										 	<?php foreach ($ok as $key2): ?>
										 		<?=number_format($key2->gaji,0,",","."); ?>
										 	<?php endforeach ?>
										 
										 </td>
										<td>
										<!-- Pengurangan -->
										<?php 
											$this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
											$this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
											$this->db->where('payroll_detail_transaksi.type','Pengurangan');
											$this->db->where('payroll_transaksi.id_teamplate',$key->id_teamplate);
											$this->db->where('payroll_transaksi.id_karyawan',$key->id_karyawan);
											$this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'gaji2');
											$ok=$this->db->get('payroll_detail_transaksi')->result();
										 ?>
										 	<?php foreach ($ok as $key3): ?>
										 		<?=number_format($key3->gaji2,0,",","."); ?>
										 	<?php endforeach ?>
										 		
										 	</td>
										<td><?php if ($key->status==1) {
											echo '<p style="color:green;">Sudah di bayar <a href="'. base_url().'kepegawaian/payroll/batal_pengambilan_gaji/'.$key->id_karyawan.'" class="tombol-batal-pengambilan">
											</a></p>';
											// echo '<p style="color:green;">Sudah di bayar <a href="'. base_url().'kepegawaian/payroll/batal_pengambilan_gaji/'.$key->id_karyawan.'" class="tombol-batal-pengambilan">
											// <i class="fa fa-close"></i></a></p>';
										}else{
											echo "<p style='color:red;'>Belum di bayar</p>";
										} ?></td>
										<td><?=$key->create_at; ?></td>
									</tr>
									<?php endforeach ?>
									</tbody>
								</table>
							</form>
							</div>
						</div>
					</div>
				</div>
			</section>

<!-- ============ MODAL ADD =============== -->
<div class="modal fade" id="largeModal" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Gaji</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'kepegawaian/payroll/pilih_teamplate_gaji'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					<div class="form-group">
						<label class="control-label col-sm-4">Nama Periode</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="id_periode" id="id_periode" style="width: 100%;">
								<option selected disabled>Pilih Periode</option>
							 <?php foreach ($dataperiode as $key): ?>
							 	<option value="<?=$key->id_periode; ?>"><?=$key->nama_periode; ?></option>
							 <?php endforeach ?>
							</select>
						</div>
					</div>
				<!-- 	<div class="form-group">
						<label class="control-label col-sm-4">Nip/Nama Pegawai</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="id_pegawai" id="id_pegawai" style="width: 100%;">
								<option selected disabled>Pilih Nip/Nama Pegawai</option>
							 <?php foreach ($datakaryawan as $key): ?>
							 	<option value="<?=$key->id_karyawan; ?>"><?=$key->nip_karyawan; ?> - <?=$key->nama_karyawan; ?></option>
							 <?php endforeach ?>
							</select>
						</div>
					</div> -->
					<div class="form-group">
						<label class="control-label col-sm-4">Nama Template</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="id_teamplate" id="id_teamplate" style="width: 100%;">
								<option selected disabled>Pilih Nama Template</option>
							 <?php foreach ($datateamplate as $key): ?>
							 	<option value="<?=$key->id_teamplate; ?>"><?=$key->nama_teamplate; ?></option>
							 <?php endforeach ?>
							</select>
						</div>
					</div>

				
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
					<button class="btn btn-info">Cari</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- ============ MODAL ADD GENERATE PERUNIT=============== -->
<div class="modal fade" id="Modal_generate_perunit" role="dialog" aria-labelledby="Modal_generate_perunit" aria-hidden="true">
	<div class="modal-dialog role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Gaji Perunit</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'kepegawaian/payroll/pilih_teamplate_gaji'?>" enctype="multipart/form-data">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				<div class="modal-body">
				
					<div class="form-group">
						<label class="control-label col-sm-4">Nama Periode</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="id_periode" id="id_periode" style="width: 100%;">
								<option selected disabled>Pilih Periode</option>
							 <?php foreach ($dataperiode as $key): ?>
							 	<option value="<?=$key->id_periode; ?>"><?=$key->nama_periode; ?></option>
							 <?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Nama Unit</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="id_pegawai" id="id_pegawai" style="width: 100%;">
								<option selected disabled>Pilih Unit Kerja</option>
							 <?php foreach ($dataunit as $key): ?>
							 	<option value="<?=$key->id_unit_kerja; ?>"><?=$key->nama_unit_kerja; ?></option>
							 <?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Nama Template</label>
						<div class="col-sm-7">
							<select class="form-control select2" name="id_teamplate" id="id_teamplate" style="width: 100%;">
								<option selected disabled>Pilih Nama Template</option>
							 <?php foreach ($datateamplate as $key): ?>
							 	<option value="<?=$key->id_teamplate; ?>"><?=$key->nama_teamplate; ?></option>
							 <?php endforeach ?>
							</select>
						</div>
					</div>

				
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
					<button class="btn btn-info">Cari</button>
				</div>
			</form>
		</div>
	</div>
</div>


		<!-- ============ MODAL Detail gaji =============== -->
<?php
foreach ($datagaji as $a) {
    $id_karyawan = $a->id_karyawan;
    $nama_karyawan = $a->nama_karyawan;
    ?>	

    <?php 
    $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
    $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji  = payroll_detail_transaksi.id_komponen_gaji');
    $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
    $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
     $this->db->where('payroll_detail_transaksi.type','Penambahan');
    $komponen_pendapatan=$this->db->get('payroll_transaksi')->result();

    $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
    $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji  = payroll_detail_transaksi.id_komponen_gaji');
    $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
    $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
     $this->db->where('payroll_detail_transaksi.type','Pengurangan');
    $komponen_potongan=$this->db->get('payroll_transaksi')->result();


    $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
    $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji  = payroll_detail_transaksi.id_komponen_gaji');
    $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
    $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
     $this->db->where('payroll_detail_transaksi.type','Perusahaan');
    $komponen_informasi=$this->db->get('payroll_transaksi')->result();
// TOTAL PENDAPATAN
 	
 	$this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
    $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
    $this->db->where('payroll_detail_transaksi.type','Penambahan');
    $this->db->select_sum('payroll_detail_transaksi.jml_gaji','total_gaji_pendapatan');
    $total_pendapatan=$this->db->get('payroll_transaksi')->row();
//TOTAL POTONGAN
    $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
    $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji = payroll_detail_transaksi.id_komponen_gaji	');
    $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
    $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
    $this->db->where('payroll_detail_transaksi.type','Pengurangan');
    $this->db->select_sum('payroll_detail_transaksi.jml_gaji','total_gaji_potongan');
    $total_potongan=$this->db->get('payroll_transaksi')->row();

//TOTAL PERUSAHAAN
    $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_transaksi = payroll_transaksi.id_transaksi');
    $this->db->join('payroll_komponen_gaji','payroll_komponen_gaji.id_komponen_gaji = payroll_detail_transaksi.id_komponen_gaji	');
    $this->db->join('payroll_group_kategori_komponen','payroll_group_kategori_komponen.id_group_kategori_komponen = payroll_komponen_gaji.id_group_kategori_komponen');
    $this->db->where('payroll_transaksi.id_karyawan',$id_karyawan);
    $this->db->where('payroll_detail_transaksi.type','Perusahaan');
    $this->db->select_sum('payroll_detail_transaksi.jml_gaji','total_gaji_perusahaan');
    $total_perusahaan=$this->db->get('payroll_transaksi')->row();

     ?>
     
<div id="detail_gaji<?php echo $id_karyawan ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 1090px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<center>
				<h3 class="modal-title" id="myModalLabel">SLIP MUKAFAAH GURU/KARYAWAN</h3>
				<h4>Periode: <?=$a->nama_periode; ?></h4>
				</center>
			</div>

			<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kepegawaian/payroll/' ?>">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group col-lg-6">
								<!-- <label class="control-label col-sm-1" >Nama</label> -->
								<div class="col-sm-12">
									Nama :  <?=$a->nama_karyawan; ?>
								</div>
								<div class="col-sm-12">
									Pendidikan :
								</div>
								<div class="col-sm-12">
									Jabatan : <?=$a->nama_unit_kerja; ?>
								</div>
								<div class="col-sm-12">
									<h4>PENDAPATAN</h4>
								</div>
								<?php foreach ($komponen_pendapatan as $key): ?>
								<div class="col-sm-12">
									
									<?=$key->nama_kategori_komponen; ?>:</b> Rp.<?=number_format($key->jml_gaji,0,",","."); ?>
								
								</div>
								<?php endforeach ?>
								<div class="col-sm-12">
									<b>Total A :</b> Rp.<?=number_format($total_pendapatan->total_gaji_pendapatan,0,",","."); ?>
								</div>
							</div>
							<div class="form-group col-lg-6">
								<div class="col-sm-12">

									<?php 
									// hitung masa kerja
										$waktuawal  = date_create($a->tgl_berkerja); //waktu di setting
										$waktuakhir = date_create(); //waktu sekarang
										$diff  = date_diff($waktuawal, $waktuakhir);
									 ?>
									Masa Kerja(Kelipatan Tahun) : <?=$diff->y; ?>Tahun <?=$diff->m; ?>Bulan
								</div>
								<div class="col-sm-12">
									Status Pegawai : 
									<?php if ($a->id_sts_karyawan ==1): ?>
										TETAP
									<?php endif ?>

									<?php if ($a->id_sts_karyawan ==0): ?>
										TIDAK TETAP
									<?php endif ?>
								</div>
								<div class="col-sm-12">
									<h4>POTONGAN</h4>
								</div>

								<?php foreach ($komponen_potongan as $key): ?>
								<div class="col-sm-12">
									 <?=$key->nama_kategori_komponen; ?> :Rp.<?=number_format($key->jml_gaji,0,",","."); ?>
								
								</div>
								<?php endforeach ?>

								<div class="col-sm-12">
									<b>Total B :</b> Rp.<?=number_format($total_potongan->total_gaji_potongan,0,",","."); ?>
								</div>
							</div>
							<div class="form-group col-lg-6">
								<div class="col-sm-12">
									<h4>INFORMASI</h4>
								</div>

								<?php foreach ($komponen_informasi as $key): ?>
								<div class="col-sm-12">
									<?=$key->nama_kategori_komponen; ?> : </b>Rp.<?=number_format($key->jml_gaji,0,",","."); ?>
					
								</div>
								<?php endforeach ?>

								<div class="col-sm-12">
									<b>Total C :</b> Rp.<?=number_format($total_perusahaan->total_gaji_perusahaan,0,",","."); ?>
								</div>
							</div>
							<hr>
							<div class="col-lg-6">
								<!-- covert ke tgl indo -->
								<?php
								 $date =  $a->create_at;
							      $createDate = new DateTime($date);
							      $tgl= $createDate->format('Y-m-d');
								 ?>
								Sukabumi, <?=tgl_indo($tgl); ?>
								<br>
								Bendahara Markaz
								<br>
								<br>

							</div>
						</div>
							
					</div>	
				</div>

				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
					<a href="<?=base_url(); ?>kepegawaian/payroll/print_slip_gaji/<?=$id_karyawan; ?>" class="btn btn-info">Print</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
}
?>
    <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Bayar Pegawai,,Apakah Anda yakin?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-bayar").submit(); // Submit form
    });
  });
  </script>