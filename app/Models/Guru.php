<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Guru extends Model
{
   use HasFactory, Notifiable;

    protected $fillable = [
        'alamat',
        'nama_lengkap',
        'no_hp',
        'gender',
        'tanggal_lahir',
        'tempat_lahir',
        'mengajar'
    ];
}
