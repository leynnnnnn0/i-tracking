<?php

namespace App\Http\Controllers\Pdf;

use App\Enum\EquipmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\MissingEquipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EquipmentPdf extends Controller
{
    public function newResponsiblePerson(Request $request)
    {
        $equipment = Equipment::withRelationships()->findOrFail($request->equipment_id);
        $pdf = Pdf::loadView('pdf.equipment-new-responsible-person', [
            'equipment' => $equipment,
            'previous_responsible_person' => $request->previous_responsible_person
        ]);
        return $pdf->setPaper('a3', 'landscape')->download('newResponsiblePerson.pdf');
    }
    public function equipmentList(Request $request)
    {
        $query = Equipment::withRelationships();
        $responsiblePerson = null;
        $accountingOfficer = null;
        $isCondemnedFilter = false;

        if ($request->filter === 'All') {
            $query->where('quantity', '>', 0);
        }

        if ($request->filter === 'Available') {
            $query->whereNot('status', EquipmentStatus::FULLY_BORROWED->value);
            $query->where('quantity', '>', 0);
        }

        if ($request->filter === 'Condemned') {
            $isCondemnedFilter = true;
            $query->whereHas('missing_equipment_log', function ($q) {
                $q->where('is_condemned', true);
            });
        }

        if ($request->filter === 'Borrowed') {
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
            'query' => $request->filter,
        ]);
        return $pdf->setPaper('a3', 'landscape')->download('equipments-' . Carbon::today()->format('F d, Y') . '.pdf');
    }

    public function missingEquipmentPdf(Request $request)
    {
        $query = MissingEquipment::query()->with('equipment');
        if ($request->filter !== 'All') {
            if ($request->filter === 'Condemned') {
                $query->where('is_condemned', true);
            } else {
                $query->where('status', $request->filter);
            }
        }

        if ($request->keyword) {
            $query->whereAny(['id'], 'like', "%$request->keyword%")
                ->orWhereHas('equipment', callback: function ($q) use ($request) {
                    $q->where('name', 'like', "%$request->keyword%");
                });
        }

        $reports = $query->get();
        $pdf = Pdf::loadView('pdf.missing-equipment-list', [
            'reports' => $reports,
        ]);

        return $pdf->setPaper('a3', 'landscape')->download('missing-equipments.pdf');
    }
}
