<?php

namespace App\Livewire;

use App\Enum\EquipmentStatus;
use App\Enum\OperatingUnitAndProject;
use App\Enum\OrganizationUnit;
use App\Livewire\Forms\ActivityLogForm;
use App\Livewire\Forms\BorrowEquipmentForm;
use App\Models\AccountingOfficer;
use App\Models\Equipment;
use App\Models\Personnel;
use App\Models\ResponsiblePerson;
use App\Traits\Deletable;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Equipments extends Component
{
    use WithPagination, WithoutUrlPagination, Deletable;
    public ActivityLogForm $activityLogForm;
    public BorrowEquipmentForm $borrowEquipmentForm;
    public $showDeleteModal = false;
    public $query = 'All';
    public $targetId;
    public $equipmentsList;
    public $operatingUnits;
    public $organizationUnits;
    public $responsiblePersons;
    public $accountingOfficers;
    // Filter
    public $keyword;
    public $accountingOfficerId;
    public $responsiblePersonId;
    public $operatingUnit;
    public $organizationUnit;
    public $quantityHint = "";

    public $showPdfModal = false;

    protected function getModel(): string
    {
        return Equipment::class;
    }

    public function resetFilter()
    {
        $this->resetPage();
        $this->keyword = null;
        $this->responsiblePersonId = null;
        $this->operatingUnit = null;
        $this->organizationUnit = null;
        $this->accountingOfficerId = null;
    }

    public function downloadPdf()
    {

        $params = [
            'filter' => $this->query,
            'keyword' => $this->keyword,
            'responsiblePersonId' => $this->responsiblePersonId,
            'operatingUnit' => $this->operatingUnit,
            'organizationUnit' => $this->organizationUnit,
            'accountingOfficerId' => $this->accountingOfficerId,
        ];

        $params = array_filter($params, function ($value) {
            return $value !== null;
        });


        return redirect()->route('equipment-pdf', $params);
    }

    public function mount()
    {
        $this->operatingUnits = OperatingUnitAndProject::values();
        $this->organizationUnits = OrganizationUnit::values();
        $this->responsiblePersons = Personnel::get()->pluck('full_name', 'id');
        $this->accountingOfficers = AccountingOfficer::get()->pluck('full_name', 'id');
        $this->showDeleteModal = false;
    }

    public function render()
    {
        $query = Equipment::query()
            ->with([
                'accounting_officer',
                'personnel',
                'missing_equipment_log' => function ($query) {
                    $query->where('is_condemned', true);
                },
                'borrowed_log' => function ($query) {
                    $query->whereNull('returned_date');
                }
            ]);

        if ($this->query === 'All') {
            $query->where('quantity', '>', 0);
        }

        if ($this->query === 'Available') {
            $query->whereNot('status', EquipmentStatus::FULLY_BORROWED->value);
            $query->where('quantity', '>', 0);
        }

        if ($this->query === 'Condemned') {
            $query->whereHas('missing_equipment_log', function ($q) {
                $q->where('is_condemned', true);
            });
        }

        if ($this->query === 'Borrowed') {
            $query->whereHas('borrowed_log', function ($q) {
                $q->whereNull('returned_date');
            });
        }

        if ($this->keyword) {
            $query->whereAny(['name', 'property_number', 'id'], 'like', "%$this->keyword%");
        }

        if ($this->responsiblePersonId) {
            $query->where('personnel_id', $this->responsiblePersonId);
        }

        if ($this->accountingOfficerId) {
            $query->where('accounting_officer_id', $this->accountingOfficerId);
        }

        if ($this->operatingUnit) {
            $query->where('operating_unit_project', $this->operatingUnit);
        }

        if ($this->organizationUnit) {
            $query->where('organization_unit', $this->organizationUnit);
        }

        $equipments = $query->latest()->paginate(10);


        return view('livewire.equipments', [
            'equipments' => $equipments
        ]);
    }

    #[On('setTargetId')]
    public function setTargetId($id)
    {
        $this->targetId = $id;
        $this->equipmentsList = Equipment::where('id', $this->targetId)
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name
                ];
            })->toArray();
        $this->borrowEquipmentForm->equipment_id = $id;
        $this->borrowEquipmentForm->start_date = Carbon::today()->format('Y-m-d');

        if ($this->borrowEquipmentForm->equipment_id) {
            $equipment = Equipment::with(['borrowed_log' => function ($query) {
                $query->whereNull('returned_date');
            }])->find($this->borrowEquipmentForm->equipment_id);

            if ($equipment) {
                $borrowed = $equipment->borrowed_log->sum('quantity');
                $available = $equipment->quantity - $borrowed;
                $this->quantityHint = "Available: " . $available;
            } else {
                $this->quantityHint = "Equipment not found";
            }
        }
    }

    public function submit()
    {
        $this->borrowEquipmentForm->validate();
        try {
            DB::transaction(function () {
                $data = $this->borrowEquipmentForm->store();
                $this->activityLogForm->setActivityLog(null, $data, "Created a borrow log", "Create");
                $this->activityLogForm->store();
            });
            Toaster::success('Successfully Created!');
            $this->dispatch('borrowLogCreated');
        } catch (Exception $e) {
            Toaster::error($e->getMessage());
            throw $e;
        }
    }

    // public function updateStatus($id)
    // {
    //     try {
    //         DB::transaction(function () use ($id) {
    //             $borrowedEquipment = BorrowedEquipment::orderBy('created_at', 'desc')->where('equipment_id', $id)->first();
    //             $before = $log;
    //             $log->update([
    //                 'returned_date' => Carbon::today()->format('Y-m-d')
    //             ]);
    //             Equipment::find($id)->update([
    //                 'status' => 'Active'
    //             ]);
    //             $this->form->setActivityLog($before, $borrowedEquipment->fresh(), 'Mark Equipment as Returned', 'Update');
    //             $this->form->store();
    //         });
    //         Toaster::success('Status Updated!');
    //         $this->dispatch('Status Updated');
    //     } catch (Exception $e) {
    //         Toaster::error($e->getMessage());
    //     }
    // }

    public function setQuery($query)
    {
        $this->query = $query;
    }
}
