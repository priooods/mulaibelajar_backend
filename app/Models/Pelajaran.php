<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pelajaran extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'img',
        'umum_id',
        'title',
        'code',
        'subs'
    ];

    public function subpel(){
        return $this->hasMany(Subspelajaran::class,'plj_id','id');
    }
    public function umum(){
        return $this->hasMany(PelUmum::class,'id','umum_id');
    }
}
