<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Afiliate extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'cde',
        'users_id',
        'rslt'
    ];
}
