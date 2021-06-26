<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pembayaran extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'status',
        'user_id',
        'waktu_lunas',
        'bukti_transfer',
        'jumlah_bayar',
        // 'expired'
    ];
    
    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function pesanan(){
        return $this->hasMany(Pesanan::class,'pembayaran_id','id');
    }
}
