<div class="row">
		<div class="col-lg-12">
			<div class="box box-success">
				<div class="box-body">
					<div class="pull-right">
                    <form class="form-horizontal" method="post" action="<?=base_url(); ?>kepegawaian/laporangaji/exportrekapgaji" enctype="multipart/form-data">
				     <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                         <input style="display: none;" type="text" name="idlembaga" value="<?=$idlembaga; ?>">
                        <input style="display: none;" type="text" name="idunitkerja" value="<?=$idunitkerja; ?>" >
                        <input style="display: none;" type="text" name="idperiode" value="<?=$idperiode; ?>">
                      <button type="submit" class="btn btn-info">Export Laporan Gaji</button>
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
					<table class="table table-bordered table-striped" style="font-size:14px;" id="example2">
						<thead>
							<tr>
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
									<td><?=$key->nip_karyawan; ?></td>
									<td><?=$key->nama_karyawan; ?></td>
									<td><?=$key->id_unit_kerja; ?></td>
									<td><?=$key->id_teamplate; ?></td>
									<td><?=$key->id_periode; ?></td>
									<td>
										<!-- Pendapatan -->
										<?php 
											$this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_detail_template = payroll_detail_template.id_detail_template');
											$this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
											$this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
											$this->db->where('payroll_detail_template.type','Penambahan');
											$this->db->where('payroll_transaksi.id_karyawan',$key->id_karyawan);
											$this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'gaji');
											$ok=$this->db->get('payroll_detail_template')->result();
										 ?>
										 	<?php foreach ($ok as $key2): ?>
										 		<?=number_format($key2->gaji,0,",","."); ?>
										 	<?php endforeach ?>
										 
										 </td>
										<td>
										<!-- Pengurangan -->
										<?php 
											$this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_detail_template = payroll_detail_template.id_detail_template');
											$this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
											$this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
											$this->db->where('payroll_detail_template.type','Pengurangan');
											$this->db->where('payroll_transaksi.id_karyawan',$key->id_karyawan);
											$this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'gaji2');
											$ok=$this->db->get('payroll_detail_template')->result();
										 ?>
										 	<?php foreach ($ok as $key3): ?>
										 		<?=number_format($key3->gaji2,0,",","."); ?>
										 	<?php endforeach ?>
									</td>
									<td><?php if ($key->status==1) {
											echo '<p style="color:green;">Sudah di bayar</p>';
										}else{
											echo "<p style='color:red;'>Belum di bayar</p>";
										} ?>		
									</td>
									<td><?=$key->create_at; ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>



<!--load datatables -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>