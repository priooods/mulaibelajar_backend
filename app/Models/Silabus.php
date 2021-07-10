<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Silabus extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'ptmn',
        'pelajaran_id'
    ];

    public function point(){
        return $this->hasMany(SilabusPoint::class);
    }

    protected $hidden = [
        'pelajaran_id',
    ];

}
