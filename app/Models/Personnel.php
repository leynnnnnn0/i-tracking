<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel extends Model
{
    /** @use HasFactory<\Database\Factories\PersonnelFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'office_id',
        'department_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone_number',
        'email',
        'position',
        'start_date',
        'end_date',
        'remarks'
    ];

    protected $table = 'personnel';

    public function casts()
    {
        return [
            'date_of_birth' => 'date',
            'start_date' => 'date',
            'end_date' => 'date'
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function getDeleteNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function equipments()
    {
        return $this->hasOne(Equipment::class);
    }
}
