<?php

namespace App\Models;

use App\Traits\HasSelectOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Fund extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\FundFactory> */
    use HasFactory, SoftDeletes, HasSelectOptions, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'name'
    ];

    protected function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
