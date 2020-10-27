<?php
defined('BASEPATH') or exit('No direct script access allowed');

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

 <style> .str{ mso-number-format:\@; } </style>
 <html>
 <table border="1" width="100%">

	   <thead>
		 <tr>
			  <td colspan="8">
			  <div align="center">
			  <!--<img style="align:center;" height="80" width="80" src="<?php echo base_url('assets/images/almatuq.png') ?>">-->
			  <h2> <?php echo $judul; ?></h2>
			  </div>
			  </td>

		 </tr>

		 <?php $i = 1;
$tot = 0;
$row = $rekapabsen->result();{
    ?>
		 <tr>
		 	  <td colspan="3">
			  <div>
			   Nama Lembaga :
			  </div>
			  </td>
			  <td colspan="5">
			  <div>
			  <?php echo $row->nama_lembaga; ?>
			  </div>
			  </td>
		 </tr>
		 <tr>
		 	  <td colspan="3">
			  <div>
			   Nama :
			  </div>
			  </td>
			  <td colspan="5">
			  <div>
			  <?php echo $row->nama_karyawan; ?>
			  </div>
			  </td>
		 </tr>

		 <tr>
		 	  <td colspan="3">
			  <div>
			   Unit Kerja :
			  </div>
			  </td>
			  <td colspan="5">
			  <div>
			  <?php echo $row->unit_kerja; ?>
			  </div>
			  </td>
		 </tr>


		 <?php }
?>


		 <tr>
			  <th>No </th>
			  <th>Hari</th>
			  <th>Tgl Absen</th>
			  <th>Status Absen</th>
			  <th>Jam Masuk</th>
			  <th>Keterangan Masuk</th>
			  <th>Jam Pulang</th>
			  <th>Keterangan Pulang</th>
		 </tr>

	</thead>

	<tbody>

		 <?php $i = 1;
$tot = 0;
foreach ($rekapabsen->result() as $data) {
    ?>


		 <tr>
			  <td style="width:30px"> <?php echo $i; ?></td>
			  <td style="width:50px"> <?php echo namahari(rubah_tgl($data->tgl_absen)); ?></td>
			  <td class="str" style="width:70px"> <?php echo $data->tgl_absen; ?></td>
			  <td align="center"style="width:100px"><?php echo $data->id_sts_hadir; ?></td>
			  <td align="center"style="width:100px"><?php echo $data->jam_masuk; ?></td>
			  <td align="center"style="width:100px"><?php echo $data->ket_hadir; ?></td>
			  <td align="center"style="width:100px"><?php echo $data->jam_keluar; ?></td>
			  <td align="center"style="width:100px"><?php echo $data->ket_pulang; ?></td>
		 </tr>

		 <?php $i++;}
?>


</tbody>

</table>

<table  width="100%">
<tbody>
		 <?php
$row = $rekapabsen->row();{
    ?>
			<tr>
				<td colspan="2">
				<div>
				 Akumulasi Keterlambatan Waktu:
				</div>
				</td>
				<td>
				<div>
				<?php echo $row->menitmasuk; ?>
				</div>
				</td>
				<td>
				<div>
				<?php echo "(menit)"; ?>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<div>
				 Akumulasi Kelebihan Waktu:
				</div>
				</td>
				<td>
				<div>
				<?php echo $row->menitkeluar; ?>
				</div>
				</td>
				<td>
				<div>
				<?php echo "(menit)"; ?>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<div>
				 Jumlah Alpa:
				</div>
				</td>
				<td>
				<div>
				<?php echo $row->jmlalpa; ?>
				</div>
				</td>
				<td>
				<div>
				<?php echo "(hari)"; ?>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<div>
				Jumlah Ijin:
				</div>
				</td>
				<td>
				<div>
				<?php echo $row->jmlijin; ?>
				</div>
				</td>
				<td>
				<div>
				<?php echo "(hari)"; ?>
				</div>
				</td>
			</tr>

			<tr>
				<td colspan="2">
				<div>
				Jumlah Sakit:
				</div>
				</td>
				<td>
				<div>
				<?php echo $row->jmlsakit; ?>
				</div>
				</td>
				<td>
				<div>
				<?php echo "(hari)"; ?>
				</div>
				</td>
			</tr>

			<?php }
?>

	</tbody>

</table>


</html>

<?php
function namahari($tanggal)
{
    //fungsi mencari namahari
    //format $tgl YYYY-MM-DD
    //harviacode.com
    $tgl = substr($tanggal, 8, 2);
    $bln = substr($tanggal, 5, 2);
    $thn = substr($tanggal, 0, 4);
    $info = date('w', mktime(0, 0, 0, $bln, $tgl, $thn));
    switch ($info) {
        case '0':return "Minggu";
            break;
        case '1':return "Senin";
            break;
        case '2':return "Selasa";
            break;
        case '3':return "Rabu";
            break;
        case '4':return "Kamis";
            break;
        case '5':return "Jumat";
            break;
        case '6':return "Sabtu";
            break;
    };
}

function rubah_tgl($date)
{
    $exp = explode('-', $date);
    if (count($exp) == 3) {
        $date = $exp[2] . '-' . $exp[1] . '-' . $exp[0];
    }
    return $date;
}
?>