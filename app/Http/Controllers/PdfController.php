<?php

namespace App\Http\Controllers;

use App\Models\UjiEmisi;
use App\Models\Kendaraan;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function index() 
    {
        $ujiemisi = UjiEmisi::findOrFail(4);

        $pdf = new FPDF('L','mm',array(250,103));  // original
        // $pdf = new FPDF('P','mm',array(250,103)); // trying portrait
        $pdf->AddPage();
        $pdf->SetFont('courier','B',11);
        $pdf->Text(45,15,date("d-m-Y"));$pdf->Text(125,20,"test");
        $pdf->Text(45,31,strtoupper($ujiemisi->odometer));$pdf->Text(196,43,"test");//tambah 7 
        $pdf->Text(45,38,strtoupper("test"));$pdf->Text(196,50,"test");//tambah 7 **tambah6
        $pdf->Text(45,44,strtoupper("test"));$pdf->Text(196,63,"test");//tambah 6 **tambah 12
        $pdf->Text(45,51,strtoupper("test"));
        $pdf->Text(45,57,strtoupper("test"));
        $pdf->Text(45,64,strtoupper("test"));
        $pdf->Text(45,70,strtoupper("test"));
        $pdf->Text(45,76,strtoupper("test"));
        $pdf->Text(45,83,strtoupper("test"));
        $pdf->Text(45,89,strtoupper("test"));
        $pdf->Text(45,95,strtoupper("test"));$pdf->Text(168,97,strtoupper("test"));
        $pdf->Text(45,101,strtoupper(date("d-m-Y",14/07/2003)));
        $pdf->Output();
        exit;
    }
}