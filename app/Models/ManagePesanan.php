<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ManagePesanan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'pesanan_id',
        'manage_kelas_id',
    ];

    public function detailkelas(){
        return $this->hasOne(ManageKelas::class,'id','manage_kelas_id');
    }
}
