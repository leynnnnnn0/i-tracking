<?php

namespace App\Livewire;

use App\Models\SupplyHistory as ModelsSupplyHistory;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Contracts\Service\Attribute\Required;

class SupplyHistory extends Component
{
    use WithPagination;
    #[Required]
    public $from;
    #[Required]
    public $to;

    public function render()
    {
        if (!$this->from || !$this->to) {
            $history = ModelsSupplyHistory::with('supply')->latest()->paginate(10);
        } else {
            $history = ModelsSupplyHistory::with('supply')
                ->whereBetween('created_at', [$this->from, $this->to])
                ->latest()
                ->paginate(10);
        }
        return view('livewire.supply-history', [
            'history' => $history
        ]);
    }
}
