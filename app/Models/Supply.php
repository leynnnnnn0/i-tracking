<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Model
{
    use SoftDeletes;
    /** @use HasFactory<\Database\Factories\SupplyFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'description',
        'unit',
        'quantity',
        'used',
        'recently_added',
        'total',
        'expiry_date',
        'is_consumable'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'is_consumable' => 'boolean',
        'quantity' => 'integer',
        'used' => 'integer',
        'total' => 'integer'
    ];


    public function supplyHistory()
    {
        return $this->hasMany(SupplyHistory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'supply_categories');
    }

    public function getNotificationIdentificationAttribute()
    {
        return "Supply #$this->id";
    }

    public function getNotificationMessageAttribute()
    {
        return "This item only have $this->total $this->unit left.";
    }

}
