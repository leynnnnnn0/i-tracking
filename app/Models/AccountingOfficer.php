<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingOfficer extends Model
{
    /** @use HasFactory<\Database\Factories\AccountingOfficerFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'office_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number'
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function responsible_persons()
    {
        return $this->hasMany(ResponsiblePerson::class);
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }
}
