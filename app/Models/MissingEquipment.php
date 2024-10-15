<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissingEquipment extends Model
{
    /** @use HasFactory<\Database\Factories\MissingEquipmentFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'equipment_id',
        'status',
        'description',
        'reported_by',
        'reported_date',
    ];

    public function casts()
    {
        return [
            'reported_date' => 'date',

        ];
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
