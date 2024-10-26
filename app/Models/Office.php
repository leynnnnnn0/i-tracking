<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Office extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\OfficeFactory> */
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'id',
        'name'
    ];

    public function accountingOfficers()
    {
        return $this->hasMany(AccountingOfficer::class);
    }

    public function personnels()
    {
        return $this->hasMany(Personnel::class);
    }

    public function getDeleteNameAttribute()
    {
        return $this->name;
    }
}
