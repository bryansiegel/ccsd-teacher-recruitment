<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// SQLite3 db connection
$db = new SQLite3('teacherRecruitment.db');

// Query to fetch all records from the teacherRecruitment table
$results = $db->query("SELECT * FROM teacherRecruitment");

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the header row
$headers = ['ID', 'Title', 'Content', 'Published', 'Link', 'Active', 'Saved'];
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $col++;
}

// Populate the data rows
$row = 2;
while ($data = $results->fetchArray(SQLITE3_ASSOC)) {
    $col = 'A';
    foreach ($data as $key => $value) {
        // Remove HTML tags from the content
        $cleanValue = strip_tags($value);
        $sheet->setCellValue($col . $row, $cleanValue);
        $col++;
    }
    $row++;
}

// Set the headers for the HTTP response
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="teacherRecruitment.xlsx"');
header('Cache-Control: max-age=0');

// Write the Excel file to the output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Close the database connection
$db->close();
exit;