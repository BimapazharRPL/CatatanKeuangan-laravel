<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class AssetController extends Controller
{
        public function index()
    {
        // Ambil data pengeluaran berdasarkan kategori 'Beli asset'
        $beliAssetData = Pengeluaran::where('katagori', 'Beli asset')->get();

        return view('asset', compact('beliAssetData'));
    }


}
