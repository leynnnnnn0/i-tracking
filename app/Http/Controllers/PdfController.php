<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function supplyListPdf()
    {
        $data = Supply::all()->toArray();
        $pdf = Pdf::loadView('pdf.SupplyList', [
            'data' => $data
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('supplies.pdf');
    }

    public function index()
    {
        return view('pdf.SupplyList', [
            'data' => Supply::all()->toArray()
        ]);
    }
}
