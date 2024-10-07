<?php

namespace App\Livewire\Forms;

use App\Enum\Unit;
use App\Models\Supply;
use App\Models\SupplyCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Masmerise\Toaster\Toaster;

class SupplyForm extends Form
{
    public $description;
    public $unit;
    public $quantity;
    public $category;
    public $expiry_date;
    public $is_consumable;
    public $used = 0;
    public $recently_added = 0;
    public $total;

    public function rules()
    {
        return [
            'description' => ['required', 'string', 'min:2'],
            'unit' => ['required', Rule::in(Unit::values())],
            'quantity' => ['required', 'numeric'],
            'used' => ['sometimes', 'required'],
            'recently_added' => ['sometimes', 'nullable', 'required'],
            'expiry_date' => ['nullable', 'date'],
            'is_consumable' => ['required'],
            'category' => ['required',  'exists:categories,id'],
            'total' => ['sometimes', 'numeric']
        ];
    }

    public function store()
    {
        self::setRecentlyAdded();
        self::setTotal();
        $this->validate();
        DB::transaction(function () {
            $supply = Supply::create($this->all());
            $supply->categories()->attach($this->category);
        });
    }

    public function update(Supply $supply)
    {
        self::setTotal();
        $validatedData = $this->validate();

        try {
            DB::transaction(function () use ($supply, $validatedData) {
                $supply->update($validatedData);
                $supply->categories()->sync($this->category);
            });
        } catch (Exception $e) {
            Toaster::error('Something went wrong:(');
        }
    }

    public function updateQuantity(Supply $supply)
    {
        $totalQuantity = (int) $this->recently_added + $supply->quantity;
        $total = $totalQuantity - $supply->used;
        $supply->update([
            'quantity' => $totalQuantity,
            'recently_added' => $this->recently_added,
            'total' => $total
        ]);
    }

    public function updateUsedValue(Supply $supply)
    {
        $supply->update([
            'used' => $supply->used += $this->used,
            'total' => $supply->total - $this->used
        ]);
    }

    public function setSupply(Supply $supply)
    {
        $this->description = $supply->description;
        $this->unit = $supply->unit;
        $this->quantity = $supply->quantity;
        $this->category = $supply->categories->pluck('id');
        $this->expiry_date = $supply->expiry_date;
        $this->is_consumable = $supply->is_consumable;
        $this->used = $supply->used;
        $this->recently_added = $supply->recently_added;
    }

    public function setTotal($quantity = null, $used = null)
    {
        $quantity ??= $this->quantity;
        $used ??= $this->used;

        $this->total = (int)$quantity - (int)$used;
    }


    public function setQuantity($recently_added = null)
    {
        $recently_added ??= $this->recently_added;
        $this->quantity += $recently_added;
    }

    public function setRecentlyAdded($quantity = null)
    {
        $quantity ??= $this->quantity;
        $this->recently_added += $quantity;
    }
}
