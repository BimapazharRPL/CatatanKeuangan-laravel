<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    protected $fillable = [
        'nama',
        'jumlah', 
        'catatan', 
        'tgl_piutang',
        'tgl_jthtempo',
    ];

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
