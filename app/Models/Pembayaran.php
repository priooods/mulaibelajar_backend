<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pembayaran extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'cde_kls',
        'cde_afl',
        'sts',
        'wktln',
        'bktf',
        'prc'
    ];
    
    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
