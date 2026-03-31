<?php
include '../config/db.php';

// FIXED PATH
require_once(__DIR__ . '/../fpdf/fpdf.php');

// CREATE PDF OBJECT
$pdf = new FPDF();
$pdf->AddPage();

// TITLE
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,'Aarya International School',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(190,10,'Student List',0,1,'C');

$pdf->Ln(5);

// TABLE HEADER
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'ID',1);
$pdf->Cell(160,10,'Name',1);
$pdf->Ln();

// DATA
$res = mysqli_query($conn,"SELECT * FROM students");

$pdf->SetFont('Arial','',12);
while($row = mysqli_fetch_assoc($res)){
    $pdf->Cell(30,10,$row['id'],1);
    $pdf->Cell(160,10,$row['name'],1);
    $pdf->Ln();
}

// OUTPUT
$pdf->Output();
?>