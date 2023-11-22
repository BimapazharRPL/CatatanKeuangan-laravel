<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = ['keterangan', 'tanggal', 'pengeluaran_id', 'pemasukan_id',
     'piutang_id', 'asset_id', 'dana_darurat_id', 'rencana_budget_id', 'hutang_id'];

    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class);
    }

    public function pemasukan()
    {
        return $this->belongsTo(Pemasukan::class);
    }

    public function piutang()
    {
        return $this->belongsTo(Piutang::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function dana_darurat()
    {
        return $this->belongsTo(Dana_darurat::class);
    }

    public function rencana_budget()
    {
        return $this->belongsTo(Rencana_budget::class);
    }

    public function hutang()
    {
        return $this->belongsTo(Hutang::class);
    }

    // tambahkan relasi ke model lainnya di sini
}

