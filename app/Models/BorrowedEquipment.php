<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowedEquipment extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowedEquipmentFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'equipment_id',
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
            'returned_date' => 'date'
        ];
    }

    public function getIsReturnedAttribute()
    {
        return $this->returned_date ? true : false;
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function getBorrowerAttributes()
    {
        return "$this->borrower_first_name $this->borrower_last_name";
    }
}
