<?php
defined('BASEPATH') or exit('No direct script access allowed');

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

header("Content-Disposition: attachment; filename= RekapAbsenDepartemen.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<style> .str{ mso-number-format:\@; } </style>

<div style="/*! width: 1170px; */overflow-x: auto;white-space: nowrap;">
    <table class="striped bordered hovered fixed">
        <thead>
            <tr>	
                <th align="left" colspan="4">
                    <?php echo "REKAP ABSEN KARYAWAN PERIODE ". $tglawal ."s/d". $tglakhir; ?>
                </th>    
            </tr>
            <tr>	
                <th colspan="4"></th>
            </tr>
            <tr>
                <th align="left" colspan="4">
                    <?php echo 'Departemen : ' .$namaunitkerja ?>
                </th> 
            </tr>   
        <thead>
    </table>
    
    <div class="pull-left"  style="width:40%;overflow-x:auto">
        <table border="1" class="striped bordered hovered fixed">
            <thead>
                 <tr >
                    <th class="bg-olive" width="50" style="text-align:center; vertical-align: middle;">No.</th>
                    <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">Nip</th>
                    <th class="bg-olive" width="200" style="text-align:center; vertical-align: middle;">Nama</th>
                    <?php 
                     $tgl = $tglawal;
                     $tglawal = date('Y-m-d', strtotime($tglawal));
                    $tglakhir = date('Y-m-d', strtotime($tglakhir));

                        while (strtotime($tgl) <= strtotime($tglakhir)) { 
                        ?>
                            <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;"><?php echo date_format(date_create($tgl),"d"); ?></th>
                            <?php 
                                $tgl = date('Y-m-d', strtotime($tgl . ' + 1 days'));
                            }
                        ?>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">  </th>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">H</th>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">HT</th>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">A</th>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">C</th>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">I</th>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">S</th>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">T</th>
                </tr>
            </thead>
                <?php 
                    $no= 0;
                    foreach ($datakaryawan as $row) { 
                    $no++;
                ?>
                    <tbody> 
                        <tr >
                            <td width="50" style="text-align:center; vertical-align: middle;"><?= $no ?></td>
                            <td class="str" width="100" style="text-align:left; vertical-align: middle;"><?= $row->nip_karyawan ?></td>
                            <td width="200" style="text-align:left; vertical-align: middle;"><?= $row->nama_karyawan ?></td>
                            <?php 
                                $tgl = $tglawal;
                                $tgl1 = $tglawal;
                                $tgl2= $tglakhir;
                                $tglawal = date('Y-m-d', strtotime($tglawal));
                                $tglakhir = date('Y-m-d', strtotime($tglakhir));


                                while (strtotime($tgl) <= strtotime($tglakhir)) {
                                    $tgl = date('Y-m-d', strtotime($tgl));
                                    $data = $this->M_laporanabsen->TampilRekapAbsensiTglId($tgl, $row->id_karyawan);
                                    if ($data){ $id =  $data['id_absen_karyawan']; ?>
                                        <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">
                                            <?php  
                                                echo $data['id_sts_hadir'] ;
                                            ?>  
                                        </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> - </td> 
                                    <?php
                                    }
                                    $tgl = date('Y-m-d', strtotime($tgl . ' + 1 days'));
                                }
                    
                                $data2 = $this->M_laporanabsen->getakumabsen($row->id_karyawan, $tgl1, $tgl2);


                                if ($data2) { ?>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data2['jmlhadir'] ?></td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data2['menitmasuk']. ' Menit'; ?></td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data2['jmlalpa']; ?> </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data2['jmlcuti']; ?> </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data2['jmlijin']; ?>  </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data2['jmlsakit']; ?>  </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data2['jmltugas']; ?>  </td>
                                <?php
                                }
                                else
                                { ?>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"></td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">0</td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">0 Menit</td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">0</td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">0</td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">0</td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">0</td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed">0</td>
                                <?php
                                }
                                ?>
                    </tbody>
                    <?php 
                    }
                    ?>
            </table>
        </div>
       
</div>


