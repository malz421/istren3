<?php
defined('BASEPATH') or exit('No direct script access allowed');


header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

header("Content-Disposition: attachment; filename= DataShiftAbsen.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<style> .str{ mso-number-format:\@; } </style>

<div style="/*! width: 1170px; */overflow-x: auto;white-space: nowrap;">
    <table class="striped bordered hovered fixed">
        <thead>
           <tr>	
				<th style="text-align:left border-style : hidden" colspan="4">
				<?php echo "DATA SHIFT KARYAWAN PERIODE ". $tglawal ."-". $tglakhir; ?>
				</th>
				
		   </tr>

            <tr>	
				<th colspan="4">
				</th>
				
		   </tr>
         <thead>
    </table>
    
    <table border="1" class="striped bordered hovered fixed">
        <thead>
        
            <tr >
                <th class="bg-olive" width="50" style="background-color:#FF0000; text-align:center; vertical-align: middle;">No.</th>
                <th  class="bg-olive" width="250" style="background-color:#FF0000; text-align:center; vertical-align: middle;">Nama</th>
                <?php
                    $tgl = $tglawal;
                    while (strtotime($tgl) <= strtotime($tglakhir)) {
                        ?>
                    <th   width="100" style="background-color:#FF0000; text-align:center; vertical-align: middle;"><?php echo date_format(date_create($tgl), "Y/m/d"); ?></td>
                    <?php
                    $tgl = date('Y-m-d', strtotime($tgl . ' + 1 days'));
                    }
                    ?>
            </tr>
        </thead>
            <?php 
            $no= 0;
            foreach ($datakaryawan as $row) { 
            $no++;
            ?>
             <tbody> 
                <tr>
                    <td width="50" style="text-align:center; vertical-align: middle;"><?= $no ?></td>
                    <td width="250" style="text-align:left; vertical-align: middle;">
                         <?= $row->nama_karyawan ?>                        
                    </td>
                        <?php
                            $tgl = $tglawal;
                            $tgl2 = $tglakhir;

                            while (strtotime($tgl) <= strtotime($tglakhir)) {
                                $tgl = date('Y-m-d', strtotime($tgl));

                                $data = $this->M_absen->TampilShiftAll($tgl, $row->id_karyawan);

                                if ($data) {
                                    $id = $data['id_shift_karyawan'];
                                    ?>
                                                            <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">

                                                                    <?php
                            echo $data['kode_shift'];
                                    ?>
                                                                </td>
                                                            <?php
                            } else {
                                    ?>
                                                                <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> - </td>
                                                            <?php
                            }
                                $tgl = date('Y-m-d', strtotime($tgl . ' + 1 days'));
                            }
                            ?>
                    
                </tr>
                
        </tbody>
            <?php 
                    }
                        ?>
    </table>


<div style="/*! width: 1170px; */overflow-x: auto;white-space: nowrap;">
    <table class="striped bordered hovered fixed">
        <thead>
         
            <tr>	
				<th colspan="3">
				</th>
				
		   </tr>
         <thead>
    </table>

      <table border="1" class="striped bordered hovered fixed">
        <thead>
          
            <tr>
                <th colspan="3" class="bg-olive" width="50" style="background-color:#FFFF00;text-align:left; ">Keterangan</th>
            </tr>
            
        </thead>
            <?php 
            $no= 0;
            foreach ($tableshift as $row) { 
            $no++;
            ?>
             <tbody> 
                <tr>
                    <td width="50" style="text-align:center; vertical-align: middle;"><?= $row->kode_shift ?></td>
                    <td width="250" style="text-align:left; vertical-align: middle;">
                         <?= $row->nama_shift ?>                        
                    </td>
                     <td width="250" style="text-align:left; vertical-align: middle;">
                         <?= date('H:i',strtotime($row->jam_masuk)). ' - '. date('H:i',strtotime($row->jam_keluar)) ?>                        
                    </td>
                    
                </tr>
                
        </tbody>
            <?php 
                    }
                        ?>
    </table>


</div>

