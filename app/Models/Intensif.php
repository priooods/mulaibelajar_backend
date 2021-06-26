<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Intensif extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'kelas',
        'jenjang'
    ];
}
