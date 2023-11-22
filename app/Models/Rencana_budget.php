<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rencana_budget extends Model
{
    protected $fillable = [
        'nama',
        'jumlah', 
        'event', 
        'katagori', 
    ];

    // public function laporan()
    // {
    //     return $this->hasMany(Laporan::class);
    // }
}
