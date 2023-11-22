<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $fillable = [
        'nama',
        'jumlah', 
        'catatan', 
        'tanggal',
        'katagori',
    ];

    // public function laporan()
    // {
    //     return $this->hasMany(Laporan::class);
    // }

    // tambahkan relasi ke model lainnya di sini
}

