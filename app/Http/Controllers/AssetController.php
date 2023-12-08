<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;


class AssetController extends Controller
{
        public function index()
    {
        // Ambil data pengeluaran berdasarkan kategori 'Beli asset'
        $beliAssetData = Pengeluaran::where('katagori', 'Beli asset')->get();
        $assets = Asset::all();

        return view('aset.index', compact('beliAssetData','assets'));
    }
    public function create()
    {
        if (Auth::check() && in_array(Auth::user()->status, ['Bapak/Admin', 'Ibu/Anggota'])) {
            return view('aset.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        Asset::create($request->all());

        return redirect()->route('asset.index')
            ->with('success', 'Asset berhasil ditambahkan');
    }

    public function show(Asset $Asset)
    {
        return view('Asset.show', compact('Asset'));
    }
    public function edit(Asset $asset)
    {
        if (Auth::check() && in_array(Auth::user()->status, ['Bapak/Admin', 'Ibu/Anggota'])) {
            return view('aset.edit', compact('asset'));
        }
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);


        $asset->update($request->all());

        return redirect()->route('asset.index')
            ->with('success', 'asset berhasil diperbarui');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('asset.index')
            ->with('success', 'asset berhasil dihapus');
    }

}
