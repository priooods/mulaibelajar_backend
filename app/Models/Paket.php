<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Paket extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'kls',
        'nme',
        'dsc',
        'jrs',
        'cde',
        'prc',
        'pplr',
        'img',
    ];

    public function pelajaran(){
        return $this->belongsToMany(Pelajaran::class);
    }

}
