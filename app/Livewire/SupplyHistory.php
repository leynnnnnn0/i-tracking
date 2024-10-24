<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\SupplyHistory as ModelsSupplyHistory;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SupplyHistory extends Component
{
    use WithPagination;
    public $from;
    public $to;
    public $name;
    public $categories;
    public $category = [];

    public function mount()
    {
        $this->categories = Category::all()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->name
            ];
        });
    }

    public function updatedFrom()
    {
        $this->resetPage();
    }
    public function updatedTo()
    {
        $this->resetPage();
    }
    public function updatedName()
    {
        $this->resetPage();
    }


    #[On('filter-supplies-history')]
    public function render()
    {
        $query = ModelsSupplyHistory::query()->with('supply', 'supply.categories');
        if ($this->name) {
            $query->whereHas('supply', function ($q) {
                $q->where('supplies.description', 'like', "%$this->name%");
            });
        }
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        }

        if ($this->category) {
            if ($this->category && is_array($this->category)) {
                $query->whereHas('supply.categories', function ($q) {
                    $q->whereIn('categories.id', $this->category);
                });
            }
        }

        $history = $query->latest()->paginate(10);
        return view('livewire.supply-history', [
            'history' => $history
        ]);
    }

    public function downloadPdf()
    {
        $params = [
            'to' => $this->to,
            'from' => $this->from,
            'name' => $this->name
        ];
        $params = array_filter($params, function ($value) {
            return $value !== null;
        });
        return redirect()->route('supplies-history-pdf', $params);
    }

    public function resetFilter()
    {
        $this->resetPage();
        $this->from = null;
        $this->to = null;
        $this->name = null;
    }

    public function filter()
    {
        $this->dispatch('filter-supplies-history');
    }
}
