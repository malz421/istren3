<?php
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('SLIP GAJI PEGAWAI');
    // $pdf->SetTopMargin(20);
    // $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->SetFont('times','', 8,'false');
    $pdf->AddPage();
    $html='<table cellspacing="1" border="0" style="border-top:1px dashed black; border-left:1px dashed black; border-right:1px dashed black; border-bottom:1px dashed black;" cellpadding="2">
                         <tr bgcolor="#ffffff">
                            <th style="font-weight:bolder;" colspan="4" align="center">MARKAZ SUKABUMI</th>
                        </tr>
                        <tr bgcolor="#ffffff">
                            <th colspan="4" align="center">(Yuhibbuna Wa Nuhibbuhu)</th>
                        </tr>
                        <tr bgcolor="#ffffff">
                            <th style="border-bottom:1px solid black; cellpadding="2" font-weight:bolder;" colspan="4" align="center">Kp.Cikaroya Rt.016 Rw.003 Ds.Gunungjaya Kec.Cisaat Kab.Sukabumi Telp: 0266-229949</th>
                        </tr>
                        <tr bgcolor="#ffffff">
                            <th style="font-weight:bolder;" colspan="4" align="center">SLIP MUKAFAAH GURU/PEGAWAI</th>
                        </tr>
                          <tr bgcolor="#ffffff">
                            <th colspan="4" align="center">';
                        $html.=$datakaryawan->nama_periode;
                        $html.='</th></tr>
                        <tr bgcolor="#ffffff">
                            <th style="font-weight:bolder;" colspan="4" align="center"></th>
                        </tr>
                        <tr bgcolor="#ffffff">
                            <th>Nama</th>
                            <th>';
                            $html.='= '.$datakaryawan->nama_karyawan;
                            $html.='</th>
                            <th>Masa Kerja(Kelipatan Tahun)</th>
                            <th>';
                            $html.='= '.$diff->y.' Tahun '.$diff->m.' Bulan';
                            $html.='</th>
                        </tr>
                         <tr bgcolor="#ffffff">
                            <th>Pendidikan</th>
                            <th>';
                            $html.='= -';
                            $html.='</th>
                            <th>Status Pegawai</th>
                            <th>';
                            $html.='= '.$statuskaryawan;
                            $html.='</th>
                        </tr>
                        <tr bgcolor="#ffffff">
                            <th style="font-weight:bolder;">PENDAPATAN</th>
                            <th></th>
                            <th style="font-weight:bolder;">POTONGAN</th>
                            <th></th>
                        </tr>';
                          $html.='<tbody><tr>';
                          // Pendapatan
                          $html.='<td>';
                        foreach ($datagaji_pendapatan as $key) {
                 
                                $html.=''.$key->nama_kategori_komponen.'<br>';
                            
                        }
                        $html.='</td>';
                        // Nominal Pendapatan
                        $html.='<td>';
                        foreach ($datagaji_pendapatan as $key) {
                               $html.='=  '.'Rp.'.number_format($key->jml_gaji,0,",",".").'<br>';
                        }
                        $html.='</td>';
                        //Potongan
                        $html.='<td>';
                        foreach ($datagaji_potongan as $key) {
                                $html.=''.$key->nama_kategori_komponen.'<br>';
                        }
                        $html.='</td>';

                            // Nominal Potongan
                        $html.='<td>';
                        foreach ($datagaji_potongan as $key) {
                                $html.='=  '.'Rp.'.number_format($key->jml_gaji,0,",",".").'<br>';
                        }
                        $html.='</td></tr>';

                        $html.='<tr>
                                    <th style="font-weight:bolder;" align="center" >TOTAL A</th>
                                    <th style="font-weight:bolder; border-top:2px solid black; ">';
                                                $html.='=  '.'Rp.'.number_format($total_pendapatan->total_gaji_pendapatan,0,",",".").'<br>';
                                    $html.='</th>
                                    <th style="font-weight:bolder;" align="center">TOTAL B</th>
                                    <th style="font-weight:bolder; border-top:2px solid black;">';
                                                $html.='=  '.'Rp.'.number_format($total_potongan->total_gaji_potongan,0,",",".").'<br>';
                                    $html.='</th></tr>';
                         $html.='<tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>';

                               $html.='<tr>
                                    <th></th>
                                    <th></th>
                                    <th style="font-weight:bolder;">INFORMASI</th>
                                    <th></th>
                                </tr>
                                  <tr>
                                    <td></td>
                                    <td></td>';
                                    $html.='<td>';
                                    foreach ($datagaji_informasi as $key) {
                                            $html.=''.$key->nama_kategori_komponen.'<br>';
                                    }
                                    $html.='</td>';

                                      // Nominal Perushaan
                                    $html.='<td>';
                                    foreach ($datagaji_informasi as $key) {
                                            $html.='=  '.'Rp.'.number_format($key->jml_gaji,0,",",".").'<br>';
                                    }
                                    $html.='</td></tr>';

                                    $html.='<tr>
                                                <th style="font-weight:bolder;" align="center"></th>
                                                <th></th>
                                                <th style="font-weight:bolder;" align="center">TOTAL C</th>
                                                <th style="font-weight:bolder; border-top:2px solid black;">';
                                                $html.='=  '.'Rp.'.number_format($total_perusahaan->total_gaji_perusahaan,0,",",".").'<br>';
                                    $html.='</th></tr>';
                                    $html.='<tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>';
                                    $html.='<tr style="background-color:grey;">
                                                <th style="font-weight:bolder;" colspan="2">Jumlah Gaji Yang Diterima (Total A - Total B)</th>
                                                <th></th>
                                                <th style="font-weight:bolder;">';
                                          $html.='<i>Rp.'.number_format($total_pendapatan->total_gaji_pendapatan-$total_potongan->total_gaji_potongan,0,",",".").'</i>';      
                                    $html.= '</th></tr>';
                                    $html.='<tr>
                                                <th style="font-weight:bolder;" colspan="2" align="center">***PERHATIAN***</th>
                                                <th align="center">'; 
                                    $html.='Sukabumi, '.tgl_indo($tgl);

                                    $html.='</th>
                                                <th></th>
                                            </tr>';
                                     $html.='<tr>
                                                <th style="" colspan="2" align="center">Simpan SLIP MUKAFAAH ini dan pastikan untuk tidak dilihat atau memperlihatkannya kepada rekan kerjanya yang lain</th>
                                                <th align="center">Bendahara Markaz</th>
                                                <th></th>
                                            </tr>';
                                    $html.='<tr>
                                                <th></th>
                                                <th></th>
                                                <th align="center">Fatuh Abdilah</th>
                                                <th></th>
                                            </tr>';


                            $html.='</tbody></table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('Slip_Gaji_pegawai.pdf', 'I');
?>