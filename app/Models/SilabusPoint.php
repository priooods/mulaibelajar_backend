<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SilabusPoint extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'silabus_id',
        'ttl',
        'desc',
    ];

    protected $hidden = [
        'silabus_id','created_at', 'updated_at'
    ];

}
