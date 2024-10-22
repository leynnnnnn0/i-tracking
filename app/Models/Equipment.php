<?php

namespace App\Models;

use App\Enum\EquipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    /** @use HasFactory<\Database\Factories\EquipmentFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'responsible_person_id',
        'organization_unit',
        'operating_unit_project',
        'property_number',
        'quantity',
        'unit',
        'name',
        'description',
        'date_acquired',
        'fund',
        'ppe_class',
        'estimated_useful_time',
        'unit_price',
        'total_amount',
        'status'
    ];

    protected $casts = [
        'is_borrowed' => 'boolean',
        'date_acquired' => 'date',
        'unit_price' => 'decimal:2', 
        'total_amount' => 'decimal:2',
        'status' => EquipmentStatus::class  
    ];


    public function getDeleteNameAttribute()
    {
        return $this->name;
    }

    public function responsible_person()
    {
        return $this->belongsTo(ResponsiblePerson::class, 'responsible_person_id');
    }

    public function borrowed_log()
    {
        return $this->hasMany(BorrowedEquipment::class);
    }

    public function missing_equipment_log()
    {
        return $this->hasMany(MissingEquipment::class);
    }

    public function total_missing_equipment()
    {
        return $this->hasOne(MissingEquipment::class)
            ->selectRaw('equipment_id, SUM(quantity) as total_quantity, MAX(is_condemned) as is_condemned')
            ->groupBy('equipment_id');
    }

    public function total_borrowed_quantity()
    {
        return $this->hasOne(BorrowedEquipment::class)
            ->selectRaw('equipment_id, SUM(quantity) as total_borrowed')
            ->groupBy('equipment_id');
    }

    public function getTotalBorrowedAttribute()
    {
        return $this->total_borrowed_quantity ? $this->total_borrowed_quantity->total_borrowed : 0;
    }

    public function getIsAvailableAttribute()
    {
        return $this->borrowed_log->count() >= 1 ? 'No' : 'Yes';
    }

    public function accounting_officer()
    {
        return $this->belongsTo(AccountingOfficer::class, ResponsiblePerson::class);
    }

    public function quantity($query)
    {
        return match ($query) {
            'All' => $this->quantity,
            'Active' => $this->quantity,
            'Borrowed' => $this->borrowed_log->sum('quantity'),
            'Condemned' => $this->missing_equipment_log->sum('quantity')
        };
    }
}
