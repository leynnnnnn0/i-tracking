<?php

namespace App\Http\Controllers;

use App\Enum\EquipmentStatus;
use App\Models\AccountingOfficer;
use App\Models\BorrowedEquipment;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\MissingEquipment;
use App\Models\Office;
use App\Models\Personnel;
use App\Models\ResponsiblePerson;
use App\Models\Supply;
use App\Models\SupplyHistory;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PdfController extends Controller
{

    public function missingEquipmentDetailsPdf($id)
    {
        $pdf = Pdf::loadView('pdf.missing-equipment', [
            'equipment' => MissingEquipment::with('equipment', 'equipment.responsible_person', 'equipment.accounting_officer', 'equipment.organization_unit', 'equipment.fund', 'equipment.personal_protective_equipment', 'equipment.operating_unit_project')->findOrFail($id)
        ]);

        return $pdf->setPaper('a4', 'download')->download('missing-equiment-' . Carbon::today()->format('Y-m-d') . '.pdf');
    }

    public function responsiblePersonsListPdf(Request $request)
    {
        $query = ResponsiblePerson::query()->with('accounting_officer');

        if ($request->keyword) {
            $query->whereAny(['first_name', 'last_name', 'email'],  'like', "%$request->keyword%");
        }

        if ($request->officer) {
            $query->where('accounting_officer_id', $request->officer);
        }

        $persons = $query->get();

        $pdf = Pdf::loadView('pdf.ResponsiblePersonsList', [
            'persons' => $persons
        ]);

        return $pdf->setPaper('a4', 'download')->download('responsible-persons.pdf');
    }

    public function accountingOfficersListPdf(Request $request)
    {
        $query = AccountingOfficer::query()->with('office');

        if ($request->keyword) {
            $query->whereAny(['first_name', 'last_name', 'email'], 'like', "%$request->keyword%");
        }

        if ($request->office) {
            $query->where('office_id', $request->office);
        }

        $officers = $query->get();

        $pdf = Pdf::loadView('pdf.accounting-officers-list', [
            'officers' => $officers
        ]);
        return $pdf->setPaper('a4', 'download')->download('accounting-officers.pdf');
    }

    public function categoriesListPdf()
    {
        $pdf = Pdf::loadView('pdf.CategoriesList', [
            'categories' => Category::all()
        ]);
        return $pdf->setPaper('a4')->download('categories.pdf');
    }
    public function officesListPdf()
    {
        $pdf = Pdf::loadView('pdf.OfficesList', [
            'offices' => Office::all()
        ]);
        return $pdf->setPaper('a4')->download('offices.pdf');
    }
    public function userListPdf(Request $request)
    {
        $query = User::query();

        if ($request->keyword) {
            $query->whereAny(['first_name', 'middle_name', 'last_name', 'email', 'phone_number'], "%$request->keyword%");
        }
        if ($request->role) {
            $query->where('role', $request->role);
        }
        $users = $query->get();
        $pdf = Pdf::loadView('pdf.user-list', [
            'users' => $users
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('users.pdf');
    }


    public function borrowedEquipmentList(Request $request)
    {
        $query = BorrowedEquipment::query()->with('equipment');
        if ($request->filter == 'Returned') {
            $query->whereNotNull('returned_date');
        }
        if ($request->filter == 'Not Returned') {
            $query->whereNull('returned_date');
        }
        if ($request->keyword) {
            $query->whereAny(['borrower_first_name', 'borrower_last_name'], 'like', "%$request->keyword%")
                ->orWhereHas('equipment', function ($q) use ($request) {
                    $q->where('name', 'like', "%$request->keyword%");
                });
        }
        $borrowedEquipments = $query->get();
        $pdf = Pdf::loadView('pdf.BorrowedLog', [
            'borrowedEquipments' => $borrowedEquipments,
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('borrowed-equipments-log.pdf');
    }

    public function supplyListPdf(Request $request)
    {
        $query = Supply::query()->with('categories');

        if ($request->keyword) {
            if ($request->keyword) {
                $query->whereAny(['description', 'id'], 'like', '%' . $request->keyword . '%');
            }
        }

        if ($request->category) {
            if ($request->category && is_array($request->category)) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', $request->category);
                });
            }
        }
        $supplies = $query->get();
        $pdf = Pdf::loadView('pdf.SupplyList', [
            'supplies' => $supplies
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('supplies.pdf');
    }

    public function personnelListPdf(Request $request)
    {
        $query = Personnel::query()
            ->with('office', 'department', 'position');

        if ($request->keyword) {
            $query->whereAny(['first_name', 'middle_name', 'last_name'], 'like', '%' . $request->keyword . '%');
        }

        if ($request->departmentId) {
            $query->where('department_id', $request->departmentId);
        }

        if ($request->position) {
            $query->where('position', $request->position);
        }

        $personnels = $query->get();

        $pdf = Pdf::loadView('pdf.personnel-list', [
            'personnels' => $personnels
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('personnels-as-of-' . Carbon::today()->format('F d, Y') . '.pdf');
    }

    public function index()
    {
        return view('pdf.missing-equipment', [
            'equipment' => MissingEquipment::first()
        ]);
    }
}
