<?php

namespace App\Models;

use App\Traits\HasSelectOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ResponsiblePerson extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ResponsiblePersonFactory> */
    use HasFactory, SoftDeletes, HasSelectOptions, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'accounting_officer_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number'
    ];

    public function getJsonAttribute()
    {
        return [
            $this->accounting_officer_id,
            $this->first_name,
            $this->middle_name,
            $this->last_name,
            $this->email,
            $this->phone_number
        ];
    }

    public function accounting_officer()
    {
        return $this->belongsTo(AccountingOfficer::class);
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

}
