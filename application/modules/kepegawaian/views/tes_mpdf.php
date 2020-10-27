<?php
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('Contoh');
    $pdf->SetTopMargin(20);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $html='<h3>Daftar Produk</h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                        <tr bgcolor="#ffffff">
                            <th align="center">Pendapatan</th>
                            <th align="center">Potongan</th>
                        </tr>';
    
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">1</td>
                             <td align="center">1</td>
                        </tr>';
            $html.='</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('daftar_produk.pdf', 'I');
?>