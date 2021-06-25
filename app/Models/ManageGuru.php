<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ManageGuru extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'guru_id',
        'pelajaran_id',
    ];
}
