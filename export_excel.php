<?php

require 'vendor/autoload.php';
require_once ("function/function.php");

$connection = connect();


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// table styling
$tableHead = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '538ED5'
        ]
    ],
];

$dateFrom = $_GET['from'];
$dateTo = $_GET['to'];

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('A1', 'Transaksi Penjualan');
$activeWorksheet->setCellValue('A2', '' . $dateFrom . ' - ' . $dateTo . '');

$activeWorksheet->mergeCells("A1:D1");
$activeWorksheet->mergeCells("A2:D2");

$activeWorksheet->getStyle('A1')->getFont()->setSize(16);
$activeWorksheet->getStyle('A2')->getFont()->setSize(12);

$activeWorksheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeWorksheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$activeWorksheet->getColumnDimension('A')->setWidth(6);
$activeWorksheet->getColumnDimension('B')->setWidth(17);
$activeWorksheet->getColumnDimension('C')->setWidth(17);
$activeWorksheet->getColumnDimension('D')->setWidth(17);

$activeWorksheet
    ->setCellValue('A3', "No.")
    ->setCellValue('B3', "Nama Pelanggan")
    ->setCellValue('C3', "Tanggal Transaksi")
    ->setCellValue('D3', "Jumlah Transaksi");

$activeWorksheet->getStyle('A3:D3')->getFont()->setSize(11);
$activeWorksheet->getStyle('A3:D3')->getFont()->setBold(true);
$activeWorksheet->getStyle('A3:D3')->applyFromArray($tableHead);

$stmt = $connection->prepare("SELECT id_transaksi, nama_pelanggan, no_telp, transaksi.date, harga_galon, p_kupon from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date >= '$dateFrom' AND transaksi.date <= '$dateTo' ORDER BY id_transaksi ASC");
$stmt->execute();
$result = $stmt->get_result();

$row = 4;
$no = 1;


while ($data = $result->fetch_assoc()) {
    $activeWorksheet
        ->setCellValue('A' . $row, $no)
        ->setCellValue('B' . $row, $data['nama_pelanggan'])
        ->setCellValue('C' . $row, $data['date'])
        ->setCellValue('D' . $row, $data['harga_galon']);
    $row++;
    $no++;
}
;

$activeWorksheet->setCellValue('C' . $row, 'Total');

$q_cont3 = $connection->prepare("SELECT SUM(harga_galon) AS 'pendapatan_date' from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date >= '$dateFrom' AND transaksi.date <= '$dateTo'");
$q_cont3->execute();
$q_cont3_result = $q_cont3->get_result();
$total = $q_cont3_result->fetch_assoc();

$activeWorksheet->setCellValue('D' . $row, $total['pendapatan_date']);



$writer = new Xlsx($spreadsheet);
$writer->save('laporan penjualan.xlsx');

echo "<meta http-equiv='refresh' content='0;url=laporan penjualan.xlsx'/>";

echo '<script type="text/javascript">setTimeout("window.close();", 100);</script>';