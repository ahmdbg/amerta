<?php
require_once './config/db.php';
require 'vendor/autoload.php';
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set column headers
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Jk');
$sheet->setCellValue('D1', 'Kelas santri');
$sheet->setCellValue('E1', 'nama murid');
$sheet->setCellValue('F1', 'status');
$sheet->setCellValue('G1', 'nomor wa');
$sheet->setCellValue('H1', 'nomor kursi');

// Style the header row
$headerStyle = [
    'font' => ['bold' => true],
    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'E2E2E2']
    ]
];
$sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

// Fetch data from database
$query = "SELECT * FROM pengunjung";
$result = mysqli_query($conn, $query);

$row = 2;
$no = 1;
while ($data = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, $data['nama']);
    $sheet->setCellValue('C' . $row, $data['jk']);
    $sheet->setCellValue('D' . $row, $data['kelas']);
    $sheet->setCellValue('E' . $row, $data['nama_murid']);
    $sheet->setCellValue('F' . $row, $data['status']);
    $sheet->setCellValue('G' . $row, $data['no_wa']);
    $sheet->setCellValue('H' . $row, $data['nomor_kursi']);
    $row++;
}

// Auto size columns
foreach(range('A','G') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Create writer and output file
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Data_Pengunjung_' . date('Y-m-d') . '.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;