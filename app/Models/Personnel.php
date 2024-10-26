<?php

namespace App\Models;

use App\Traits\HasSelectOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Personnel extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\PersonnelFactory> */
    use HasFactory, SoftDeletes, HasSelectOptions, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'office_id',
        'department_id',
        'position_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone_number',
        'email',
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
        return $this->hasMany(Equipment::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function getNotificationTitleAttribute()
    {
        return  "Personnel: {$this->full_name} (Id: {$this->id}).";
    }

    public function getNotificationMessageAttribute()
    {
        return "The end date will be {$this->end_date->diffForHumans()}.";
    }
}
