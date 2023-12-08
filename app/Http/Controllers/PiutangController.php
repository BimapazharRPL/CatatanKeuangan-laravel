<?php

namespace App\Http\Controllers;

use App\Models\Piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PiutangController extends Controller
{
    public function index()
    {
        $piutangs = Piutang::all();
        return view('piutang.index', compact('piutangs'));
    }

    public function create()
    {
        if (Auth::check() && in_array(Auth::user()->status, ['Bapak/Admin', 'Ibu/Anggota'])) {
        return view('piutang.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'catatan' => 'required|string',
            'tgl_piutang' => 'required|date',
            'tgl_jthtempo' => 'required|date',
        ]);

        Piutang::create($request->all());

        return redirect()->route('piutang.index')
            ->with('success', 'Piutang berhasil ditambahkan');
    }

    public function show(Piutang $piutang)
    {
        return view('piutang.show', compact('piutang'));
    }

    public function edit(Piutang $piutang)
    {
        if (Auth::check() && in_array(Auth::user()->status, ['Bapak/Admin', 'Ibu/Anggota'])) {
        return view('piutang.edit', compact('piutang'));
        }
    }

    public function update(Request $request, Piutang $piutang)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'catatan' => 'required|string',
            'tgl_piutang' => 'required|date',
            'tgl_jthtempo' => 'required|date',
        ]);

        $piutang->update($request->all());

        return redirect()->route('piutang.index')
            ->with('success', 'Piutang berhasil diperbarui');
    }

    public function destroy(Piutang $piutang)
    {
        $piutang->delete();

        return redirect()->route('piutang.index')
            ->with('success', 'Piutang berhasil dihapus');
    }

}