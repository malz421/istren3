<?php
defined('BASEPATH') or exit('No direct script access allowed');

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

header("Content-Disposition: attachment; filename= RekapGaji.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<style> .str{ mso-number-format:\@; } </style>

<div style="/*! width: 1170px; */overflow-x: auto;white-space: nowrap;">
    <table class="striped bordered hovered fixed">
        <thead>
             <tr>   
                <th colspan="9" align="center" style="font-size: 50px;">
                    <?=$datalembaga->nama_lembaga; ?>
                </th>    
            </tr>
            <tr>	
                <th colspan="9" align="center">
                    <?php echo "REKAP GAJI PEGAWAI ";?>
                </th>    
            </tr>
            <tr>	
                <th colspan="9" align="center">PERIODE <?=$dataperiode->nama_periode; ?></th>
            </tr>  
        <thead>
    </table>
    
    <div class="pull-left"  style="width:40%;overflow-x:auto">
        <table border="1">
            <thead>
                <tr style="background: orange;">
                    <th>No</th>
                   <th colspan="4">Nip</th>
                    <th>Nama Karyawan</th>
                    <th>Unit</th>
                    <th>Pendapatan</th>
                    <th>Potongan</th>
                    <th>Perusahaan</th>
                </tr>
            </thead>
            <tbody>
                            <?php $no = 0; ?>
                            <?php foreach ($datagaji as $key): ?>
                                <?php 
                                $id = $key['id_karyawan'];
                                $no++;
                                ?>
                                <tr>
                                    <td><?=$no; ?></td>
                                    <td colspan="4" class="str" style="text-align: center;"><?=$key['nip_karyawan']; ?></td>
                                    <td style="text-align: center;"><?=$key['nama_karyawan']; ?></td>
                                    <td style="text-align: center;"><?=$key['nama_unit_kerja']; ?></td>
                                    <td style="text-align: center;">
                                        <!-- Pendapatan -->
                                        <?php 
                                            $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_detail_template  = payroll_detail_template.id_detail_template ');
                                            $this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
                                            $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
                                            $this->db->where('payroll_detail_template.type','Penambahan');
                                            $this->db->where('payroll_transaksi.id_karyawan',$key['id_karyawan']);
                                            $this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'Pendapatan');
                                            $ok=$this->db->get('payroll_detail_template')->result();
                                         ?>
                                            <?php foreach ($ok as $key1): ?>
                                                <?=number_format($key1->Pendapatan,0,",","."); ?>
                                            <?php endforeach ?>
                                         
                                         </td>
                                         <!-- Potongan -->
                                             <td style="text-align: center;">
                                        <?php 
                                            $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_detail_template  = payroll_detail_template.id_detail_template ');
                                            $this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
                                            $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
                                            $this->db->where('payroll_detail_template.type','Pengurangan');
                                            $this->db->where('payroll_transaksi.id_karyawan',$key['id_karyawan']);
                                            $this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'Potongan');
                                            $ok1=$this->db->get('payroll_detail_template')->result();
                                         ?>
                                            <?php foreach ($ok1 as $key2): ?>
                                                <?=number_format($key2->Potongan,0,",","."); ?>
                                            <?php endforeach ?>
                                         
                                         </td>
                                         <!-- Perushaan -->
                                             <td style="text-align: center;">
                                        <!-- Pendapatan -->
                                        <?php 
                                            $this->db->join('payroll_detail_transaksi','payroll_detail_transaksi.id_detail_template  = payroll_detail_template.id_detail_template ');
                                            $this->db->join('payroll_transaksi','payroll_transaksi.id_transaksi = payroll_detail_transaksi.id_transaksi');
                                            $this->db->join('karyawan','karyawan.id_karyawan = payroll_transaksi.id_karyawan');
                                            $this->db->where('payroll_detail_template.type','Perusahaan');
                                            $this->db->where('payroll_transaksi.id_karyawan',$key['id_karyawan']);
                                            $this->db->select_sum('payroll_detail_transaksi.jml_gaji', 'Perushaan');
                                            $ok2=$this->db->get('payroll_detail_template')->result();
                                         ?>
                                            <?php foreach ($ok2 as $key3): ?>
                                                <?=number_format($key3->Perushaan,0,",","."); ?>
                                            <?php endforeach ?>
                                         
                                         </td>

                                   <!--  <td style="text-align: center;"><?php if ($key->status==1) {
                                            echo '<p style="color:green;">Sudah di bayar</p>';
                                        }else{
                                            echo "<p style='color:red;'>Belum di bayar</p>";
                                        } ?>        
                                    </td> -->
                                </tr>
                            <?php endforeach ?>
                            <tr style="background: green;">
                                <th colspan="7" align="left">TOTAL</th>
                               <th><?=number_format($total_pendapatan->Pendapatan,0,",","."); ?></th>
                                 <th><?=number_format($total_potongan->Potongan,0,",","."); ?></th>
                                 <th><?=number_format($total_perushaan->Perusahaan,0,",","."); ?></th>
                            </tr>
                        </tbody>
        </table>
        </div>
       
</div>


