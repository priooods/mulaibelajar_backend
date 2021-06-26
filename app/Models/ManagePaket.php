<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ManagePaket extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'paket_pelajaran_id',
        'manage_kelas_id'
    ];

    public function detail(){
        return $this->hasOne(PaketPelajaran::class,'id','paket_pelajaran_id');
    }
    public function pelajaran(){
        return $this->hasMany(ManageKelas::class,'id','manage_kelas_id');
    }
}
