<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    use SoftDeletes;

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
