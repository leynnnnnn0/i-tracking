<?php

namespace App\Models;

use App\Traits\HasSelectOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, SoftDeletes, HasSelectOptions, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name'
    ];

    public function supplies()
    {
        return $this->belongsToMany(Supply::class, 'supply_categories');
    }


    public function getDeleteNameAttribute()
    {
        return $this->name;
    }
}
