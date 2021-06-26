<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaketPelajaran extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'harga',
        'deskripsi',
        'jurusan',
        'kelas_id'
    ];

    public function detail_pelajaran(){
        return $this->hasMany(ManagePaket::class, 'paket_pelajaran_id', 'id');
    }
    public function kelas(){
        return $this->hasOne(Kelas::class, 'id', 'kelas_id');
    }
    public function voucher(){
        return $this->hasMany(Voucher::class, 'paket_id', 'id');
    }
}
