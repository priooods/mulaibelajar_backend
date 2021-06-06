<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'context_text',
        'content_file',
        'pertemuan',
    ];
}
