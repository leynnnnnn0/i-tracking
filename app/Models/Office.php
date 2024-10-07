<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    /** @use HasFactory<\Database\Factories\OfficeFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function accountingOfficers()
    {
        return $this->hasMany(AccountingOfficer::class);
    }
}
