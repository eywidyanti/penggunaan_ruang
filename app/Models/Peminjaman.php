<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $guarded =[
        'nim',
                'nama',
                'kelas',
                'telp',
                'tanggal',
                'keperluan',
                'jam_masuk',
                'jam_keluar',
                'jam_kembali',
                'denda',
                'status',
                'user',
                'ruang',
    ];
}
