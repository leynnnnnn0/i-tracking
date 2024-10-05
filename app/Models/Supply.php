<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    /** @use HasFactory<\Database\Factories\SupplyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'cost_per_piece'
    ];
}
