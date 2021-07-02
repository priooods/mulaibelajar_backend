<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subspelajaran extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'img',
        'plj_id',
        'kls_id',
        'title',
        'subs',
        'level'
    ];

    public function kelas(){
        return $this->hasOne(Kelas::class,'id','kls_id');
    }
    public function harga(){
        return $this->hasOne(ManageKelas::class,'plj_id','id');
    }
}
