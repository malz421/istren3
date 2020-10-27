

<section class="content">
<div class="row">
		<div class="col-lg-12">
			<div class="box box-success">
				<div class="box-body">
					<div class="pull-right">
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'kepegawaian/LaporanAbsen/ExportRekapAbsenDep'?>" enctype="multipart/form-data">
				     <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                         <input type="text" name="tglperiode1" value="<?php echo $tglawal ?>" style="display: none">
                        <input type="text" name="tglperiode2" value="<?php echo $tglakhir ?>" style="display: none">
                        <input type="text" name="idlembaga" value="<?php echo $idlembaga ?>" style="display: none">
                        <input type="text" name="idunitkerja" value="<?php echo $idunitkerja ?>" style="display: none">
                      <button type="submit" class="btn btn-info">Export Daftar Absen Per Departemen</button>
                    </form>
					</div>
				</div>
			</div>
		</div>
</div>

<div style="/*! width: 1170px; */overflow-x: auto;white-space: nowrap;">
        <div class="pull-left"  style="width:40%;overflow-x:auto">
            <table class="table table-striped ">
                <thead>
                    <tr >
                        <th class="bg-olive" width="50" style="text-align:center; vertical-align: middle;">No.</th>
                        <th class="bg-olive" width="100" style="text-align:center; vertical-align: middle;">Nip</th>
                        <th class="bg-olive" width="200" style="text-align:center; vertical-align: middle;">Nama</th>
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
                            <td  width="100" style="text-align:left; vertical-align: middle;">
                              <?= $row->nip_karyawan ?>                           <!--<a href="https://absenku.com/absenku_demo/web/index.php/daftar_shift_karyawan/edit/012" style="text-align: right" onclick="" title="Edit"><img src="https://absenku.com/absenku_demo/web/images/icon-pencil.png"  style="width:12px;height:15px;"></a>-->
                            </td>
                            <td width="200" style="text-align:left; vertical-align: middle;">
                              <?= $row->nama_karyawan ?>                           <!--<a href="https://absenku.com/absenku_demo/web/index.php/daftar_shift_karyawan/edit/012" style="text-align: right" onclick="" title="Edit"><img src="https://absenku.com/absenku_demo/web/images/icon-pencil.png"  style="width:12px;height:15px;"></a>-->
                            </td>
                           
                        </tr>
                </tbody>
                 <?php 
                    }
                 ?>
            </table>
        </div>
        <div class="pull-right" style="width:60%;overflow-x:auto">
            <table class="table table-striped">
                <thead>
                   <tr>
                    <?php 
                     $tgl = $tglawal;
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
                        <tr>
                            <?php 
                            $tgl = $tglawal;
                            $tgl2 = $tglakhir;

                            while (strtotime($tgl) <= strtotime($tglakhir)) {
                                $tgl = date('Y-m-d', strtotime($tgl));

                                $data = $this->M_laporanabsen->TampilRekapAbsensiTglId($tgl, $row->id_karyawan);
                              
                                if ($data){ 
                                    $id =  $data['id_absen_karyawan'];
                                    ?>
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
                            ?>

                            <?php

                               
                                $data1 = $this->M_laporanabsen->getakumabsen($row->id_karyawan, $tglawal, $tglakhir);

                                if ($data1) { ?>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data1['jmlhadir'] ?></td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data1['menitmasuk']. ' Menit'; ?></td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data1['jmlalpa']; ?> </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data1['jmlcuti']; ?> </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data1['jmlijin']; ?>  </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data1['jmlsakit']; ?>  </td>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> <?php echo $data1['jmltugas']; ?>  </td>
                                <?php
                                }
                                else
                                { ?>
                                    <td width="100" style="text-align:center; vertical-align: middle;table-layout: fixed"> </td>
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
                        </tr>
                         </tbody>
                    <?php
                        }
                    ?>
                   
            </table>
        </div>
    </div>
</section>

