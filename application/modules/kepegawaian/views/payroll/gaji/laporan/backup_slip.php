<?php
echo "About to create pdf";
$pdf= new FPDF('L','pt','A4');
$pdf->SetTitle('Slip Gaji Pegawai');
$pdf->AliasNbPages();
$pdf->SetTopMargin(40);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
$pdf->SetAutoPageBreak(true, 50);




$pdf->AddPage();
// $pdf->Image('./assets/img/logo.png',32,25,50);
$pdf->SetFont('Times','B',16);
$pdf->Cell(150);//margin rightnya
$pdf->Cell(500,10,'MARKAZ AL-MATUQ SUKABUMI',0,0,'C');
$pdf->Ln(20);

$pdf->SetFont('Times','BI',14);
$pdf->Cell(150);//margin rightnya
$pdf->Cell(500,10,'(Yuhibbuna Wa Nuhibbuhu)',0,0,'C');
$pdf->Ln(20);

$pdf->Cell(150);
$pdf->SetFont('Times','',10);
$pdf->Cell(500,10,'Kp.Cikaroya Rt.016 Rw.003 Kec.Cisaat Kab.Sukabumi Telp: 0266-229949',0,0,'C');

$pdf->SetLineWidth(3);//ketebalan gaji/lebar garis
$pdf->Line(20,100,820,100);
$pdf->SetLineWidth(1,5);
$pdf->ln(30);

$pdf->SetFont('Times','B',15);
$pdf->Cell(150);//margin rightnya
$pdf->Cell(500,10,'SLIP MUKAFAAH GURU/PEGAWAI',0,0,'C');
$pdf->Ln(20);
$Periode=$komponen->row();
$pdf->SetFont('Times','',15);
$pdf->Cell(150);//margin rightnya
$pdf->Cell(500,10,'Periode : '.$Periode->nama_periode,0,0,'C');
$pdf->Ln(40);

$pdf->SetX(40);//margin left
$pdf->SetFont('Times','BU',13);
$pdf->Cell(130,15,"PENDAPATAN",1,"LR","L");
// $pdf->Ln();

$pdf->SetX(400);//margin left
$pdf->SetFont('Times','BU',13);
$pdf->Cell(130,15,"POTONGAN",1,"LR","L");
$pdf->Ln();

if (!empty($komponen->result())) {
	// $no=0;
	$nilaiY=$pdf->GetY();
	foreach ($komponen->result() as $key ) {

	// $no++;
	
		$pdf->SetX(40);
		$pdf->SetFont('Times','BU',10);
		if ($key->nama_kategori=="Pendapatan") {
		$pdf->Cell(130,40,$key->nama_kategori_komponen.' : Rp.'.number_format($key->jml_gaji,0,",","."),0,"LR","L");
		$pdf->Cell(130,40,$key->nama_kategori_komponen.' : Rp.'.number_format($key->jml_gaji,0,",","."),0,"LR","L");
		}if($key->nama_kategori=="Potongan"){
			$pdf->Cell(130,40,$key->nama_kategori_komponen.' : Rp.'.number_format($key->jml_gaji,0,",","."),0,"LR","L");
		}else{}
		$pdf->Ln();

	
	
	$nilaiY=$pdf->GetY();
}
# code...
	}

	$pdf->Output('slip_gaji_pegawai-'.date('dFY').'.pdf','I');
	# code...

?>

