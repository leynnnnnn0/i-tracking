<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissingEquipment extends Model
{
    /** @use HasFactory<\Database\Factories\MissingEquipmentFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        
    ];
}
