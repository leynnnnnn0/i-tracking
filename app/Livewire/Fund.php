<?php

namespace App\Livewire;

use App\Livewire\Forms\ActivityLogForm;
use App\Traits\Deletable;
use Livewire\Component;
use Livewire\WithPagination;

class Fund extends Component
{
    use WithPagination, Deletable;

    public ActivityLogForm $activityLogForm;
    protected function getModel(): string
    {
        return \App\Models\Fund::class;
    }
    public function render()
    {
        return view('livewire.fund', [
            'funds' => \App\Models\Fund::class::latest()->paginate(10)
        ]);
    }
}
