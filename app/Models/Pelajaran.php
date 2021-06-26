<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pelajaran extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'deskripsi',
        'nama_pelajaran',
        'kode_pelajaran',
        'subtitle'
    ];
}
