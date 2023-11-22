<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukans = Pemasukan::all();
        return view('pemasukan.index', compact('pemasukans'));
    }

    public function create()
    {
        return view('pemasukan.create');
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

        Pemasukan::create($request->all());

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan berhasil ditambahkan');
    }

    public function show(Pemasukan $pemasukan)
    {
        return view('pemasukan.show', compact('pemasukan'));
    }

    public function edit(Pemasukan $pemasukan)
    {
        return view('pemasukan.edit', compact('pemasukan'));
    }

    public function update(Request $request, Pemasukan $pemasukan)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'catatan' => 'required|string',
            'tanggal' => 'required|date',
            'katagori' => 'required|string',
        ]);

        $pemasukan->update($request->all());

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan berhasil diperbarui');
    }

    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan berhasil dihapus');
    }

    // public function generateReport()
    // {
    //     $pemasukanData = Pemasukan::all();

    //     return view('laporan', ['pemasukanData' => $pemasukanData]);
    // }
}


// use App\Models\Pemasukan;
// use Illuminate\Http\Request;

// class PemasukanController extends Controller
// {
//     public function index()
//     {
//         $pemasukan = Pemasukan::all();
//         return view('pemasukan.index', compact('pemasukan'));
//     }

//     public function create()
//     {
//         return view('pemasukan.create');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'nama' => 'required|string',
//             'jumlah' => 'required|integer',
//             'catatan' => 'required|string',
//             'tanggal' => 'required|date',
//             'katagori' => 'required|string',
//         ]);

//         Pemasukan::create($request->all());
//         return redirect()->route('pemasukan.index');
//     }

//     public function edit(Pemasukan $pemasukan )
//     {
//         return view('pemasukan.edit', compact('pemasukan'));
//     }

//     public function update(Request $request, Pemasukan $pemasukan)
//     {
//         $request->validate([
//             'nama' => 'required|string',
//             'jumlah' => 'required|integer',
//             'catatan' => 'required|string',
//             'tanggal' => 'required|date',
//             'kategori' => 'required|string',
//         ]);

//         $pemasukan->update($request->all());

//         return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil diperbarui');
//     }
//     // public function update(Request $request, Pemasukan $pemasukan)
//     // {
//     //     $pemasukan->update($request->all());
//     //     return redirect()->route('pemasukan.index');
//     // }

//     public function destroy(Pemasukan $pemasukan)
//     {
//         $pemasukan->delete();
//         return redirect()->route('pemasukan.index');
//     }
// }

