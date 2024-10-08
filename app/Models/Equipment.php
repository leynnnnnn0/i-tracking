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

    public function borrowed_log()
    {
        return $this->hasMany(BorrowedEquipment::class);
    }

    public function getIsAvailableAttribute()
    {
        return $this->borrowed_log->count() >= 1 ? 'No' : 'Yes';
    }

    

}
