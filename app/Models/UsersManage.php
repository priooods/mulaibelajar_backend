<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersManage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kelas_id',
        'status_bayar',
        'bayar'
    ];
}
