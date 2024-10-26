<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class OperatingUnitProject extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\OperatingUnitProjectFactory> */
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'name'
    ];

    protected function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
