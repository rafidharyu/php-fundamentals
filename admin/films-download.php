<?php

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

require 'vendor/autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

$activeWorksheet->setCellValue('A2', 'No')->getColumnDimension('A')->setAutoSize(true);
$activeWorksheet->setCellValue('B2', 'Nama')->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->setCellValue('C2', 'Studio')->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->setCellValue('D2', 'Status')->getColumnDimension('D')->setAutoSize(true);
$activeWorksheet->setCellValue('E2', 'Category')->getColumnDimension('E')->setAutoSize(true);
$activeWorksheet->setCellValue('F2', 'Created At')->getColumnDimension('F')->setAutoSize(true);

$styleColumn = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$no = 1;
$loc = 3;

$films = query("SELECT f.id_film, f.title, f.studio, f.is_private, f.created_at, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category ORDER BY f.created_at DESC");

foreach ($films as $film) {
    $activeWorksheet->setCellValue('A' . $loc, $no++);
    $activeWorksheet->setCellValue('B' . $loc, $film['title']);
    $activeWorksheet->setCellValue('C' . $loc, $film['studio']);
    $activeWorksheet->setCellValue('D' . $loc, $film['is_private'] ? 'Private' : 'Public');
    $activeWorksheet->setCellValue('E' . $loc, $film['category_title']);
    $activeWorksheet->setCellValue('F' . $loc, $film['created_at']);
    $loc++;
}

$activeWorksheet->getStyle('A2:F' . ($loc - 1))->applyFromArray($styleColumn);

$writer = new Xlsx($spreadsheet);
$file_name = 'Films List.xlsx';
$writer->save($file_name);

// ganti proses download ke folder download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($file_name));
header('Content-Disposition: attachment; filename="' . $file_name . '"');
readfile($file_name);
unlink($file_name);
