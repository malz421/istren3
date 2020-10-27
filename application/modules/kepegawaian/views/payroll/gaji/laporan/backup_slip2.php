<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Laporan Penggajian');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MARKAZ  AL MATUQ SUKABUMI'.'', '(Yuhibbuna Wa Nuhibbuhu)');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();
$left_column ='Pendapatan<hr>';
$right_column ='Potongan<hr>';
$left_column2 ='Perusahaan<hr>';
// create columns content
foreach ($datagaji as $key) {
       if ($key->type == "Penambahan") {
        $left_column .= '<p>'.$key->nama_kategori_komponen.' = '.$key->jml_gaji.'</p>';
         $left_column .= '<p>shjsdhjshd</p>';
         $left_column .= '<p>shjsdhjshd</p>';
         $left_column .= '<p>shjsdhjshd</p>';
          $left_column .= '<p>shjsdhjshd</p>';
           $left_column .= '<p>shjsdhjshd</p>';
            $left_column .= '<p>shjsdhjshd</p>';

    }
}
foreach ($datagaji as $key) {
    if ($key->type == "Pengurangan") {
        $right_column .= '<p>'.$key->nama_kategori_komponen.' = '.$key->jml_gaji.'</p>';
    }
}

foreach ($datagaji as $key) {
    if ($key->type == "Perusahaan") {
        $right_columnn .= '<p>'.$key->nama_kategori_komponen.' = '.$key->jml_gaji.'</p>';
    }
}

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// get current vertical position
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 200);

// set color for text
$pdf->SetTextColor(0, 63, 127);

// write the first column
$pdf->writeHTMLCell(80, '', '', $y, $left_column, 0, 0, 0, true, 'J', true);

// set color for background
$pdf->SetFillColor(215, 235, 255);

// set color for text
$pdf->SetTextColor(127, 31, 0);

// write the second column
$pdf->writeHTMLCell(80, '', '', '', $right_column, 0, 0, 0, true, 'J', true);

$pdf->Ln();
$pdf->Ln();
$pdf->SetTextColor(127, 31, 0);

// write the second column
$pdf->writeHTMLCell(80, '', '', '', $left_column2, 0, 0, 0, true, 'J', true);


// reset pointer to the last page
$pdf->lastPage();



// ---------------------------------------------------------
   // $pdf->writeHTML($html, true, false, true, false, '');
//Close and output PDF document
$pdf->Output('example_007.pdf', 'I');