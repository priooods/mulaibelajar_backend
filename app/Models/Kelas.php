<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_kelas',
        'harga_awal',
        'harga_akhir',
        'discount',
        'tanggal_mulai',
        'tanggal_selesai',
        'desc_kelas',
    ];

    public function content(){
        return $this->hasMany(KelasContent::class, 'kelas_id', 'id');
    }
}
