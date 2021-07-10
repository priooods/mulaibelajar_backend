<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Harga extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'pelajaran_id',
        'prc',
        'prcd',
        'dsc',
    ];

    protected $hidden = [
        'pelajaran_id',
    ];
}
