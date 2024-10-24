<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'id',
        'name'
    ];

    public function personnel()
    {
        return $this->hasMany(Personnel::class);
    }

    public function getDeleteNameAttribute()
    {
        return $this->name;
    }
}
