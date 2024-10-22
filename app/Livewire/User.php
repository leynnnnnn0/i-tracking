<?php

namespace App\Livewire;

use App\Enum\UserRole;
use App\Livewire\Forms\ActivityLogForm;
use App\Models\User as ModelsUser;
use App\Traits\Deletable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class User extends Component
{
    use WithPagination, Deletable;
    public ActivityLogForm $activityLogForm;
    public $keyword;
    public $roles;
    public $role;

    protected function getModel(): string
    {
        return ModelsUser::class;
    }

    public function mount()
    {
        $this->roles = UserRole::values();
    }
    public function render()
    {
        $query = ModelsUser::query();

        if ($this->keyword) {
            $query->whereAny(['first_name', 'middle_name', 'last_name', 'phone_number', 'email'], 'like', "%$this->keyword%");
        }

        if ($this->role) {
            $query->where('role', $this->role);
        }

        $users = $query->latest()->paginate(10);

        return view('livewire.user', [
            'users' => $users
        ]);
    }

    public function resetFilter()
    {
        $this->keyword = null;
        $this->role = null;
    }

    public function downloadPdf()
    {
        $params = [
            'role' => $this->role,
            'keyword' => $this->keyword
        ];

        $params = array_filter($params, function ($value) {
            return $value !== null && $value !== '';
        });
        
        return redirect()->route('users-pdf', $params);
    }


}
