<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PengalamanGuru extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'guru_id',
        'tahun_mulai',
        'tahun_selesai',
        'pelajaran',
        'sekolah',
    ];
}
