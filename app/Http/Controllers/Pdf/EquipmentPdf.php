<?php

namespace App\Http\Controllers\Pdf;

use App\Enum\EquipmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EquipmentPdf extends Controller
{
    public function equipmentList(Request $request)
    {
        $query = Equipment::withRelationships();
        $responsiblePerson = null;
        $accountingOfficer = null;

        if ($request->query === 'All') {
            $query->where('quantity', '>', 0);
        }

        if ($request->query === 'Available') {
            $query->whereNot('status', EquipmentStatus::FULLY_BORROWED->value);
            $query->where('quantity', '>', 0);
        }

        if ($request->query === 'Condemned') {
            $query->whereHas('missing_equipment_log', function ($q) {
                $q->where('is_condemned', true);
            });
        }

        if ($request->query === 'Borrowed') {
            $query->whereHas('borrowed_log', function ($q) {
                $q->whereNull('returned_date');
            });
        }


        if ($request->organizationUnit) {
            $query->where('organization_unit_id', $request->organizationUnit);
        }

        if ($request->operatingUnit) {
            $query->where('operating_unit_project_id', $request->operatingUnit);
        }

        if ($request->keyword) {
            $query->whereAny(['name', 'property_number', 'id'], 'like', "%$request->keyword%");
        }

        if ($request->responsiblePersonId) {
            $query->where('personnel_id', $request->responsiblePersonId);
        }

        if ($request->accountingOfficerId) {
            $query->where('accounting_officer_id', $request->accountingOfficerId);
        }

        $equipments = $query->latest()->get();

        if ($request->responsiblePersonId) {
            $responsiblePerson = $equipments->first()->responsible_person->full_name;
        }

        if ($request->accountingOfficerId) {
            $accountingOfficer = $equipments->first()->accounting_officer->full_name;
        }

        $pdf = Pdf::loadView('pdf.equipment-list', [
            'title' => 'Equipment List',
            'responsiblePerson' => $responsiblePerson ?? false,
            'accountingOfficer' => $accountingOfficer ?? false,
            'equipments' => $equipments,
        ]);
        return $pdf->setPaper('a3', 'landscape')->download('equipments-' . Carbon::today()->format('F d, Y') . '.pdf');
    }
}
