<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ManageIntensif extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'intensif_id',
        'manage_kelas_id'
    ];

    public function detail(){
        return $this->hasOne(Intensif::class,'id','intensif_id');
    }
    public function pelajaran(){
        return $this->hasMany(ManageKelas::class,'id','manage_kelas_id');
    }
}
