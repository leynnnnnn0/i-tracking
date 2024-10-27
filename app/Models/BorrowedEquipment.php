<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class BorrowedEquipment extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\BorrowedEquipmentFactory> */
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'borrowed_equipment_id',
        'equipment_id',
        'quantity',
        'borrower_first_name',
        'borrower_last_name',
        'borrower_phone_number',
        'borrower_email',
        'start_date',
        'end_date',
        'returned_date'
    ];


    public function casts()
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'returned_date' => 'date',
        ];
    }

    public function getIsReturnedAttribute()
    {
        return $this->returned_date ? true : false;
    }

    public function getFullNameAttribute()
    {
        return "$this->borrower_first_name $this->borrower_last_name";
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function getBorrowerAttributes()
    {
        return "$this->borrower_first_name $this->borrower_last_name";
    }

    public function getNotificationTitleAttribute()
    {
        return  "Return Reminder: {$this->equipment->name} (PN: {$this->equipment->property_number}).";
    }

    public function missing_equipment()
    {
        return $this->hasOne(MissingEquipment::class);
    }

    public function getNotificationMessageAttribute()
    {
        if ($this->end_date < now()->format('Y-m-d')) {
            return "This equipment's return date has already passed.";
        } else if ($this->end_date->format('Y-m-d') === today()->format('Y-m-d')) {
            return "This equipment's return date is today.";
        } else {
            return "The equipment is scheduled for return in {$this->end_date->diffForHumans()}.";
        }
    }
}
