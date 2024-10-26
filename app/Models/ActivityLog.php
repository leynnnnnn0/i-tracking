<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityLogFactory> */
    use HasFactory;


    protected $fillable = [
        'office_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number'
    ];

    protected $casts = [
        'before_data' => 'array',
        'after_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
