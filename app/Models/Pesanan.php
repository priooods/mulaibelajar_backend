<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pesanan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'harga',
        'paket',
        'intensif_id',
        'voucher_id',
    ];

    public function detail(){
        return $this->hasOne(ManagePesanan::class,'pesanan_id','id');
    }
}
