<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Notification extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'is_read',
    ];

    public function casts()
    {
        return [
            'is_read' => 'boolean'
        ];
    }
}
