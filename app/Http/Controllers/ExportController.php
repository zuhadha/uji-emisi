<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\UjiEmisi;
use App\Models\Kendaraan;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    // public function export()
    // {
    //         // Create a new Spreadsheet object
    //     $spreadsheet = new Spreadsheet();

    //     // Set the value of cell A1 to 'Hello World!'
    //     $activeWorksheet = $spreadsheet->getActiveSheet();
    //     $activeWorksheet->setCellValue('A1', 'Hello World !');

    //     // Create a writer object for Xlsx format
    //     $writer = new Xlsx($spreadsheet);

    //     // Set headers for file download
    //     $headers = [
    //         'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    //         'Content-Disposition' => 'attachment;filename="hello_world.xlsx"',
    //         'Cache-Control' => 'max-age=0'
    //     ];

    //     // Save the spreadsheet to a temporary file
    //     $tempFile = tempnam(sys_get_temp_dir(), 'excel');
    //     $writer->save($tempFile);

    //     // Read the temporary file content
    //     $fileContent = file_get_contents($tempFile);

    //     // Delete the temporary file
    //     unlink($tempFile);

    //     // Return the file content as a response
    //     return response($fileContent, 200, $headers);
    // }
    public function export()
    {
        // Query uji emisi dengan join ke tabel kendaraan
        $ujiemisis = UjiEmisi::with('kendaraan')
            ->join('kendaraans', 'uji_emisis.kendaraan_id', '=', 'kendaraans.id')
            ->select('uji_emisis.*') // Pilih kolom dari uji_emisis
            ->get();
    
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
    
        // Set the headers for the spreadsheet and make them bold
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Nomor Polisi')->getStyle('A1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Merk Kendaraan')->getStyle('B1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Tipe Kendaraan')->getStyle('C1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Tahun')->getStyle('D1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Bahan Bakar')->getStyle('E1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Tanggal Uji')->getStyle('F1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Odometer')->getStyle('G1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'CO')->getStyle('H1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'CO2')->getStyle('I1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('J1', 'HC')->getStyle('J1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('K1', 'Opasitas')->getStyle('K1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('L1', 'O2')->getStyle('L1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('M1', 'Lambda')->getStyle('M1')->getFont()->setBold(true);

        // Set light grey background color for all header cells
        $headerCells = ['A1', 'B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1', 'I1', 'J1', 'K1', 'L1', 'M1'];
        foreach ($headerCells as $cell) {
            $spreadsheet->getActiveSheet()->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID);
            $spreadsheet->getActiveSheet()->getStyle($cell)->getFill()->getStartColor()->setRGB('D3D3D3'); // Light grey color
        }
    
        // Write data to the spreadsheet
        $row = 2; // start from row 2 for data
        foreach ($ujiemisis as $ujiemisi) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $ujiemisi->kendaraan->nopol);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $ujiemisi->kendaraan->merk);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $ujiemisi->kendaraan->tipe);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $ujiemisi->kendaraan->tahun);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $ujiemisi->kendaraan->bahan_bakar);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, date('d/m/Y', strtotime($ujiemisi->tanggal_uji)));
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $ujiemisi->odometer);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $ujiemisi->co);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $ujiemisi->co2);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $row, $ujiemisi->hc);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $ujiemisi->opasitas);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $row, $ujiemisi->o2);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $row, $ujiemisi->lambda);
            $row++;
        }
    
        // Apply black border with 1px weight for the entire table
        $spreadsheet->getActiveSheet()->getStyle('A1:M' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    
        // Create a writer object for Xlsx format
        $writer = new Xlsx($spreadsheet);
    
        // Set headers for file download
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="ujiemisi.xlsx"',
            'Cache-Control' => 'max-age=0'
        ];
    
        // Save the spreadsheet to a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');
        $writer->save($tempFile);
    
        // Read the temporary file content
        $fileContent = file_get_contents($tempFile);
    
        // Delete the temporary file
        unlink($tempFile);
    
        // Return the file content as a response
        return response($fileContent, 200, $headers);
    }
}


