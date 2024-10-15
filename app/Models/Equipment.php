<?php

namespace App\Models;

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

    public function casts()
    {
        return [
            'is_borrowed' => 'boolean',
            'date_acquired' => 'date',
            'unit_price' => 'double',
            'total_amount' => 'double'
        ];
    }

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
        return $this->belongsToMany(MissingEquipment::class);
    }

    public function getIsAvailableAttribute()
    {
        return $this->borrowed_log->count() >= 1 ? 'No' : 'Yes';
    }
}
