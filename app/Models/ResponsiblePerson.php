<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsiblePerson extends Model
{
    /** @use HasFactory<\Database\Factories\ResponsiblePersonFactory> */
    use HasFactory;

    protected $fillable = [
        'accounting_officer_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number'
    ];

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
