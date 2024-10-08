<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    /** @use HasFactory<\Database\Factories\OfficeFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'id',
        'name'
    ];

    public function accountingOfficers()
    {
        return $this->hasMany(AccountingOfficer::class);
    }
}
