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
        'pembayaran_id',
        'harga',
        'paket',
        'paket_id',
        'type',
        'voucher_id',
    ];

    public function detail(){
        return $this->hasOne(ManagePesanan::class,'pesanan_id','id');
    }
    public function detail_pesanan(){
        return $this->hasMany(PaketPelajaran::class,'id','paket_id');
    }
}
