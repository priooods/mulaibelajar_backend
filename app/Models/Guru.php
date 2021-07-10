<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Guru extends Model
{
   use HasFactory, Notifiable;

    protected $fillable = [
        'almt',
        'flnm',
        'nhp',
        'gndr',
        'tglhr',
        'tmlhr',
        'mgjr'
    ];
}
