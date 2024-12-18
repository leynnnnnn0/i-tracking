<?php

namespace App\Models;

use App\Traits\HasSelectOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AccountingOfficer extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\AccountingOfficerFactory> */
    use HasFactory, SoftDeletes, HasSelectOptions,  \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'office_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number'
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function responsible_persons()
    {
        return $this->hasMany(ResponsiblePerson::class);
    }

    public function getFullNameAttribute()
    {
        return  "$this->first_name $this->last_name" ?? 'N/a';
    }

    public function getDeleteNameAttribute()
    {
        return $this->full_name;
    }
}
