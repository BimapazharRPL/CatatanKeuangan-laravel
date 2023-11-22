<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    protected $fillable = [
        'nama',
        'jumlah', 
        'catatan', 
        'tgl_hutang',
        'tgl_jthtempo',
    ];

    // public function laporan()
    // {
    //     return $this->hasMany(Laporan::class);
    // }
}
