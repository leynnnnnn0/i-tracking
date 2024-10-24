<?php

namespace App\Models;

use App\Traits\Deletable;
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

    public function formattedCategories($categories)
    {
        return implode(' / ', $categories->map(function ($item) {
            return $item->name;
        })->toArray());
    }


    public function supplyHistory()
    {
        return $this->hasMany(SupplyHistory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'supply_categories');
    }

    public function getNotificationTitleAttribute()
    {
        return "Supply #$this->id ($this->description)";
    }

    public function getDeleteNameAttribute()
    {
        return $this->description;
    }

    public function getNotificationMessageAttribute()
    {
        if ($this->total < 10) {
            return "This item only have $this->total $this->unit left.";
        }
        if ($this->expiry_date < now()) {
            return "This item is already expired.";
        } else {
            return "This item will expire " . $this->expiry_date->diffForHumans();
        }
    }

    public function getformattedExpiryDateAttribute()
    {
        return $this->expiry_date ? $this->expiry_date->format('Y-m-d') : 'N/a';
    }
}
