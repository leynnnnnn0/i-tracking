<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    /** @use HasFactory<\Database\Factories\EquipmentFactory> */
    use HasFactory;

    protected $fillable = [
        'responsible_person_id',
        'uid',
        'name',
        'is_borrowed'
    ];

    public function casts()
    {
        return [
            'is_borrowed' => 'boolean'
        ];
    }

    public function responsible_person()
    {
        return $this->belongsTo(ResponsiblePerson::class, 'responsible_person_id');
    }
}
