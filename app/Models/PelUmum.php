<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelUmum extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'deskripsi',
        'img'
    ];
    public function pelajaran(){
        return $this->hasMany(Pelajaran::class,'umum_id','id');
    }
}
