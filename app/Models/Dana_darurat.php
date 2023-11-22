<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana_darurat extends Model
{
    protected $fillable = [
        'nama',
        'catatan', 
        'jumlah', 
        'tanggal',
    ];

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
