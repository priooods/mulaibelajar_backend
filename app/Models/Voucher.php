<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Voucher extends Model
{
   use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'kode',
        'potongan',
        'mulai',
        'paket',
        'selesai',
        'paket_id',
    ];
}
