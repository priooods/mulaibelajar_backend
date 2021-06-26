<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ManageKelas extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'kelas_id',
        'pelajaran_id',
        'harga',
    ];

    public function Kelas(){
        return $this->hasOne(Kelas::class,'id', 'kelas_id');
    }
    public function Pelajaran(){
        return $this->hasOne(Pelajaran::class,'id', 'pelajaran_id');
    }
}
