<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    public function index()
    {
        $hutangs = Hutang::all();
        return view('hutang.index', compact('hutangs'));
    }

    public function create()
    {
        return view('hutang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'catatan' => 'required|string',
            'tgl_hutang' => 'required|date',
            'tgl_jthtempo' => 'required|date',
        ]);

        Hutang::create($request->all());

        return redirect()->route('hutang.index')
            ->with('success', 'Hutang berhasil ditambahkan');
    }

    public function show(Hutang $hutang)
    {
        return view('hutang.show', compact('hutang'));
    }

    public function edit(Hutang $hutang)
    {
        return view('hutang.edit', compact('hutang'));
    }

    public function update(Request $request, Hutang $hutang)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'catatan' => 'required|string',
            'tgl_hutang' => 'required|date',
            'tgl_jthtempo' => 'required|date',
        ]);

        $hutang->update($request->all());

        return redirect()->route('hutang.index')
            ->with('success', 'Hutang berhasil diperbarui');
    }

    public function destroy(Hutang $hutang)
    {
        $hutang->delete();

        return redirect()->route('hutang.index')
            ->with('success', 'Hutang berhasil dihapus');
    }

}