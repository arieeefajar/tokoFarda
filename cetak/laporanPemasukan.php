<?php
require('../vendor/fpdf/fpdf.php');
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggalMulai = $_POST['tanggalMulai1'];
    $tanggalSampai = $_POST['tanggalSampai1'];

    $timestamp = strtotime($tanggalMulai);
    $formattedDate = date("d F Y", $timestamp);

    $timestamp1 = strtotime($tanggalSampai);
    $formattedDate1 = date("d F Y", $timestamp1);

    $koneksi = new koneksi();
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(200, 10, 'LAPORAN DATA PEMASUKAN', 0, 0, 'C');
    $pdf->Cell(10, 8, '', 0, 1);
    $pdf->Cell(200, 10, 'DARI TANGGAL ' . $formattedDate . ' SAMPAI TANGGAL ' . $formattedDate1, 0, 0, 'C');

    $pdf->Cell(10, 15, '', 0, 1);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'NO', 1, 0, 'C');
    $pdf->Cell(50, 7, 'KODE TRANSAKSI', 1, 0, 'C');
    $pdf->Cell(75, 7, 'TANGGAL', 1, 0, 'C');
    $pdf->Cell(55, 7, 'TOTAL', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);

    $no = 1;
    $query = "SELECT Kode_TransaksiJual, Tanggal, Total FROM transaksi_jual WHERE Tanggal BETWEEN '$tanggalMulai' AND '$tanggalSampai'";
    $query1 = "SELECT SUM(Total) as totalPendapatan FROM transaksi_jual WHERE Tanggal BETWEEN '$tanggalMulai' AND '$tanggalSampai'";

    $result = $koneksi->execute($query);
    $result1 = $koneksi->execute($query1);

    foreach ($result as $key => $data) {
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(50, 6, $data['Kode_TransaksiJual'], 1, 0);
        $pdf->Cell(75, 6, $data['Tanggal'], 1, 0);
        $pdf->Cell(55, 6, 'Rp. ' . number_format($data['Total']), 1, 1);
    }

    foreach ($result1 as $key => $data1) {
        $pdf->Cell(190, 7, 'TOTAL PENDAPATAN: Rp. ' . number_format($data1['totalPendapatan']), 1, 0, 'R');
    }

    $pdf->Output();
}
