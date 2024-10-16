<?php

namespace App\Livewire;

use App\Models\SupplyHistory as ModelsSupplyHistory;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Contracts\Service\Attribute\Required;

class SupplyHistory extends Component
{
    use WithPagination;
    public $from;
    public $to;

    #[On('filter-supplies-history')]
    public function render()
    {
        $query = ModelsSupplyHistory::query()->with('supply');
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        }
        $history = $query->latest()->paginate(10);
        return view('livewire.supply-history', [
            'history' => $history
        ]);
    }

    public function resetFilter()
    {
        $this->from = null;
        $this->to = null;
    }

    public function filter()
    {
        $this->dispatch('filter-supplies-history');
    }
}
