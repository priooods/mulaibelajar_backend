<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pelajaran extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'pplr',
        'kelas_id',
        'titl',
        'desc',
        'nick',
        'cde',
        'img',
        'type',
        'lvl',
    ];

    public function harga(){
        return $this->hasOne(Harga::class);
    }
    public function kelas(){
        return $this->hasOne(Kelas::class,'id','kelas_id');
    }
    public function silabus(){
        return $this->hasMany(Silabus::class,'pelajaran_id','id');
    }

    public function paket(){
        return $this->belongsToMany(Paket::class);
    }

    protected $hidden = [
        'kelas_id',
    ];
}
