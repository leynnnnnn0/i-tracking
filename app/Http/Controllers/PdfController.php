<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Supply;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function equipmentListPdf(Request $request)
    {

        $query = Equipment::query()
            ->with('responsible_person', 'borrowed_log');

        if ($request->filter !== 'All') {
            $query->where('status', $request->filter);
        }

        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('property_number', 'like', '%' . $request->keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->keyword . '%')
                    ->orWhereHas('responsible_person', function ($subQuery) use ($request) {
                        $subQuery->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $request->keyword . '%')
                            ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
                            ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                            ->orWhere('middle_name', 'like', '%' . $request->keyword . '%');
                    });
            });
        }

        if ($request->responsiblePersonId) {
            $query->where('responsible_person_id', $request->responsiblePersonId);
        }

        if ($request->operatingUnit) {
            $query->where('operating_unit_project', $request->operatingUnit);
        }

        if ($request->organizationUnit) {
            $query->where('organization_unit', $request->organizationUnit);
        }

        $equipments = $query->latest()->get();

        $pdf = Pdf::loadView('pdf.EquipmentList', [
            'data' => $equipments,
            'isResponsiblePersonFiltered' => $request->responsiblePersonId ? $equipments->where('responsible_person_id', $request->responsiblePersonId)->first()->responsible_person->full_name : false
        ]);

        return $pdf->setPaper('a4', 'landscape')->download('equipments.pdf');
    }

    public function index()
    {
        return view('pdf.EquipmentNewResponsiblePerson');
    }
}
