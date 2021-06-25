<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Silabus extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'pertemuan',
        'waktu',
        'guru_id',
        'manage_kelas_id'
    ];
}
