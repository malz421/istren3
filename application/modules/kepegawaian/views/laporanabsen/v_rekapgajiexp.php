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
                    <?php echo "REKAP GAJI PEGAWAI "; ?>
                </th>    
            </tr>
            <tr>	
                <th colspan="4"></th>
            </tr>
            <tr>
                <th align="left" colspan="4">
  <!--                   <?php echo 'Departemen : ' .$namaunitkerja ?> -->
                </th> 
            </tr>   
        <thead>
    </table>
    
    <div class="pull-left"  style="width:40%;overflow-x:auto">
        
        </div>
       
</div>


