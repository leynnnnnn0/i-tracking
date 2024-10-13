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
            'used' => ['sometimes', 'required', 'lte:quantity'],
            'recently_added' => ['sometimes', 'nullable', 'required'],
            'expiry_date' => ['nullable', 'date'],
            'is_consumable' => ['required'],
            'category' => ['required',  'exists:categories,id'],
            'total' => ['sometimes', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'used.lte' => 'The used quantity must be less than or equal to the total quantity'
        ];
    }

    public function store()
    {
        self::setRecentlyAdded();
        self::setTotal();
        $this->validate();
        $supply = null;
        DB::transaction(function () use (&$supply) {
            $supply = Supply::create($this->all());
            $supply->categories()->attach($this->category);
        });
        return $supply;
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
        } finally {
            return $supply->fresh();
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
        return $supply->fresh();
    }

    public function updateUsedValue(Supply $supply)
    {
        $totalUsed = $supply->used += $this->used;
        if ($totalUsed > $supply->quantity) {
            throw new Exception('The total used value cannot exceed the total supply available.');
        }
        $supply->update([
            'used' => $totalUsed,
            'total' => $supply->total - $this->used
        ]);
        $this->reset();

        return $supply->fresh();
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
        $this->total = $supply->total;
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
