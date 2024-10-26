<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SupplyCategory extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\SupplyCategoryFactory> */
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'supply_id',
        'category_id'
    ];
}
