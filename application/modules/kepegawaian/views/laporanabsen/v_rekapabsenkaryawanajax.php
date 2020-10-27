

<section class="content">
<div class="row">
		<div class="col-lg-12">
			<div class="box box-success">
				<div class="box-body">
					<div class="pull-right">
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'kepegawaian/LaporanAbsen/ExportRekapAbsenKaryawan'?>" enctype="multipart/form-data">
				     <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                         <input type="text" name="tglperiode1" value="<?php echo $tglawal ?>" style="display: none">
                        <input type="text" name="tglperiode2" value="<?php echo $tglakhir ?>" style="display: none">
                        <input type="text" name="idlembaga" value="<?php echo $idlembaga ?>" style="display: none">
                        <input type="text" name="idunitkerja" value="<?php echo $idunitkerja ?>" style="display: none">
                         <input type="text" name="idkaryawan" value="<?php echo $idkaryawan ?>" style="display: none">
                      <button type="submit" class="btn btn-info">Export Daftar Absen Per Karyawan</button>
                    </form>
					</div>
				</div>
			</div>
		</div>
</div>


<div class="row">
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
	</div>




</section>

