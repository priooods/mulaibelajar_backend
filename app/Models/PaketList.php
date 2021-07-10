<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaketList extends Model
{
    
    use HasFactory, Notifiable;

    protected $fillable = [
        'paket_id',
        'pelajaran_id',
    ];

    public function plj(){
        return $this->hasOne(Pelajaran::class, 'id', 'pelajaran_id');
    }
    public function pkt(){
        return $this->belongsToMany(Paket::class);
    }

    protected $hidden = [
        'paket_id',
        'created_at', 'updated_at'
    ];
}
