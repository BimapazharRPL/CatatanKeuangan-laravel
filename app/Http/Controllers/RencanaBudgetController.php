<?php

namespace App\Http\Controllers;

use App\Models\Rencana_budget;
use Illuminate\Http\Request;

class RencanaBudgetController extends Controller
{
    public function index()
    {
        $rencana_budgets = Rencana_budget::all();
        return view('rencana.index', compact('rencana_budgets'));
    }

    public function create()
    {
        return view('rencana.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'event' => 'required|string',
            'katagori' => 'required|string',
        ]);

        Rencana_budget::create($request->all());

        return redirect()->route('rencana.index')
            ->with('success', 'Rencana_budget berhasil ditambahkan');
    }

    public function show(Rencana_budget $rencana)
    {
        return view('rencana.show', compact('rencana'));
    }

    public function edit(Rencana_budget $rencana)
    {
        return view('rencana.edit', compact('rencana'));
    }

    public function update(Request $request, Rencana_budget $rencana)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'event' => 'required|string',
            'katagori' => 'required|string',
        ]);

        $rencana->update($request->all());

        return redirect()->route('rencana.index')
            ->with('success', 'Rencana_budget berhasil diperbarui');
    }

    public function destroy(Rencana_budget $rencana)
    {
        $rencana->delete();

        return redirect()->route('rencana.index')
            ->with('success', 'Rencana_budget berhasil dihapus');
    }
}
