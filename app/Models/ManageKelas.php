<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ManageKelas extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'plj_id',
        'harga_akhir',
        'harga_discount',
        'discount',
    ];
}
