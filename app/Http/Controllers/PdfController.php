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
        // asli
        // $pdf = new FPDF('L','mm',array(250,103));
        // //$pdf = new FPDF('P','mm','A4');
        // $pdf->AddPage();
        // $pdf->SetFont('courier','B',13);
        // $pdf->Text(45,25,date("d-m-Y"));$pdf->Text(125,20,$no_seri);
        // $pdf->Text(45,31,strtoupper($row->merk));$pdf->Text(196,43,$statusCo);//tambah 7 
        // $pdf->Text(45,38,strtoupper($row->type));$pdf->Text(196,50,$statusHc);//tambah 7 **tambah6
        // $pdf->Text(45,44,strtoupper($row->tahun));$pdf->Text(196,63,$statusOpa);//tambah 6 **tambah 12
        // $pdf->Text(45,51,strtoupper($row->cc));
        // $pdf->Text(45,57,strtoupper($row->vin));
        // $pdf->Text(45,64,strtoupper($row->nomesin));
        // $pdf->Text(45,70,strtoupper($row->bahan_bakar));
        // $pdf->Text(45,76,strtoupper($row->odometer));
        // $pdf->Text(45,83,strtoupper($rowBengkel->nama));
        // $pdf->Text(45,89,strtoupper($rowBengkel->alamat));
        // $pdf->Text(45,95,strtoupper($row->nopol));$pdf->Text(168,97,strtoupper($name));
        // $pdf->Text(45,101,strtoupper(date("d-m-Y",$dateKadaluarsa)));
        // //$pdf->Text(57,24,$row->nopol);
        // $pdf->Output();
        $ujiemisi = UjiEmisi::findOrFail(4);

        $pdf = new FPDF('L','mm',array(250,103));
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