<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::all();
        return view('pengeluaran.index', compact('pengeluarans'));
    }

    public function create()
    {
        if (Auth::check() && in_array(Auth::user()->status, ['Bapak/Admin', 'Ibu/Anggota'])) {
        return view('pengeluaran.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'catatan' => 'required|string',
            'tanggal' => 'required|date',
            'katagori' => 'required|string',
        ]);

        Pengeluaran::create($request->all());

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.show', compact('pengeluaran'));
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        if (Auth::check() && in_array(Auth::user()->status, ['Bapak/Admin', 'Ibu/Anggota'])) {
        return view('pengeluaran.edit', compact('pengeluaran'));
        }
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'catatan' => 'required|string',
            'tanggal' => 'required|date',
            'katagori' => 'required|string',
        ]);

        $pengeluaran->update($request->all());

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus');
    }
}


