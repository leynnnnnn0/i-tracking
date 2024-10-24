<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    /** @use HasFactory<\Database\Factories\FundFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name'
    ];

    protected function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
