<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{

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

        $pdf = Pdf::loadView('pdf.AccountingOfficersList', [
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
        $pdf = Pdf::loadView('pdf.UserList', [
            'users' => $users
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('users.pdf');
    }

    public function supplyHistoryPdf(Request $request)
    {
        $query = SupplyHistory::query()->with('supply');
        if ($request->name) {
            $query->whereHas('supply', function ($q) use ($request) {
                $q->where('supplies.description', $request->name);
            });
        }
        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }
        $supplies = $query->get();
        $pdf = Pdf::loadView('pdf.SupplyHistoryList', [
            'supplies' => $supplies,
            'from' => $request->from,
            'to' => $request->to,
        ]);
        return $pdf->setPaper('a4')->download('supplies-history.pdf');
    }

    public function missingEquipmentPdf(Request $request)
    {
        $pdf = Pdf::loadView('pdf.MissingEquipmentList', [
            'equipments' => MissingEquipment::with('equipment')->get(),
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('missing-equipments.pdf');
    }

    public function handleEquipmentNewResponsiblePerson(Request $request)
    {
        $equipment = Equipment::with('responsible_person')->findOrFail($request->equipment_id);
        $pdf = Pdf::loadView('pdf.EquipmentNewResponsiblePerson', [
            'equipment' => $equipment,
            'previous_responsible_person' => $request->previous_responsible_person
        ]);
        return $pdf->setPaper('a4')->download('newResponsiblePerson.pdf');
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
        $query = Supply::query();

        if ($request->keyword) {
            if ($request->keyword) {
                $query->whereAny(['description', 'id'], 'like', '%' . $request->keyword . '%');
            }
        }

        if ($request->category) {
            $query->when($request->category, function ($query) use ($request) {
                return $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('categories.id', $request->category);
                });
            });
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
            ->with('department',);

        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('middle_name', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->departmentId) {
            $query->where('department_id', $request->departmentId);
        }

        if ($request->position) {
            $query->where('position', $request->position);
        }

        $personnels = $query->get();

        $pdf = Pdf::loadView('pdf.PersonnelList', [
            'personnels' => $personnels
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('personnels-as-of-' . Carbon::today()->format('F d, Y') . '.pdf');
    }

    public function equipmentListPdf(Request $request)
    {

        $query = Equipment::query()
            ->with('responsible_person', 'borrowed_log', 'responsible_person.accounting_officer', 'total_missing_equipment');

            if ($request->query === 'All') {
                $query->where('quantity', '>', 0);
            }
    
            if ($request->query === 'Condemned') {
                $query->whereHas('total_missing_equipment', function ($q) {
                    $q->where('is_condemned', true);
                });
            }
    
            if ($request->query === 'Borrowed') {
                $query->where('status', $request->query);
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

        if ($request->accountingOfficerId) {
            $query->whereHas('responsible_person.accounting_officer', function ($q) use ($request) {
                $q->where('id', $request->accountingOfficerId);
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
        $isAccountingOfficerFiltered = null;
        if ($request->accountingOfficerId) {
            $isAccountingOfficerFiltered = AccountingOfficer::find($request->accountingOfficerId)->full_name;
        }

        $pdf = Pdf::loadView('pdf.EquipmentList', [
            'data' => $equipments,
            'isAccountingOfficerFiltered' => $isAccountingOfficerFiltered,
            'isResponsiblePersonFiltered' => $request->responsiblePersonId ? $equipments->where('responsible_person_id', $request->responsiblePersonId)->first()->responsible_person->full_name : false,
            'query' => $request->query
        ]);

        return $pdf->setPaper('a4', 'landscape')->download('equipments-' . Carbon::today()->format('F d, Y') . '.pdf');
    }

    public function index()
    {
        return view('pdf.MissingEquipmentList', [
            'supplies' => SupplyHistory::with('supply')->get()
        ]);
    }
}
