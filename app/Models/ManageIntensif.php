<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ManageIntensif extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'intensif_id',
        'manage_kelas_id'
    ];
}
