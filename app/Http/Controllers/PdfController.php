<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Supply;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Event;

class PdfController extends Controller
{

    public function handleEquipmentNewResponsiblePerson($equipment_id, $previous_responsible_person)
    {
        $equipment = Equipment::with('responsible_person')->findOrFail($equipment_id);
        $pdf = Pdf::loadView('pdf.EquipmentNewResponsiblePerson', [
            'equipment' => $equipment,
            'previous_responsible_person' => $previous_responsible_person
        ]);
        return $pdf->setPaper('a4')->download('newResponsiblePerson.pdf');
    }

    public function supplyListPdf()
    {
        $data = Supply::all()->toArray();
        $pdf = Pdf::loadView('pdf.SupplyList', [
            'data' => $data
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('supplies.pdf');
    }

    public function equipmentListPdf()
    {
        $data = Equipment::all();
        $pdf = Pdf::loadView('pdf.EquipmentList', [
            'data' => $data
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('equipments.pdf');
    }

    public function index()
    {
        return view('pdf.EquipmentNewResponsiblePerson');
    }
}
