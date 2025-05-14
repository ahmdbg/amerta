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

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

// Style the header row with green background and white bold font
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
        'size' => 12,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => '2E7D32'] // dark green
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '1B5E20'], // darker green border
        ],
    ],
];
$sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

// Get gender filter from query parameter
$jk_param = isset($_GET['jk']) ? $_GET['jk'] : '';

$jk_map = [
    'laki-laki' => 'L',
    'perempuan' => 'P'
];

$jk_filter = isset($jk_map[$jk_param]) ? $jk_map[$jk_param] : '';

if ($jk_filter) {
    $query = "SELECT * FROM pengunjung WHERE jk = '$jk_filter'";
} else {
    $query = "SELECT * FROM pengunjung";
}

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

    // Apply alternating row colors with green shades
    $fillColor = ($row % 2 == 0) ? 'C8E6C9' : 'E8F5E9'; // light green shades
    $sheet->getStyle("A{$row}:H{$row}")->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $fillColor],
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => 'A5D6A7'], // medium green border
            ],
        ],
    ]);
    $row++;
}

// Auto size columns
foreach(range('A','H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

$filename = 'Data_Pengunjung_' . ($jk_param ? $jk_param : 'semua') . '_' . date('Y-m-d') . '.xlsx';
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
