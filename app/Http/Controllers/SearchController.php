<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Hutang;
use App\Models\Piutang;
use App\Models\Asset;
use App\Models\Rencana_budget;
use Illuminate\Http\Request;

class SearchController extends Controller
{
        
    public function searchGlobal(Request $request)
    {
        $query = $request->get('query');

        $pemasukans = Pemasukan::where('nama', 'like', "%$query%")
            ->orWhere('jumlah', 'like', "%$query%")
            ->orWhere('catatan', 'like', "%$query%")
            ->orWhere('tanggal', 'like', "%$query%")
            ->orWhere('katagori', 'like', "%$query%")
            ->get();

        $pengeluarans = Pengeluaran::where('nama', 'like', "%$query%")
            ->orWhere('jumlah', 'like', "%$query%")
            ->orWhere('catatan', 'like', "%$query%")
            ->orWhere('tanggal', 'like', "%$query%")
            ->orWhere('katagori', 'like', "%$query%")
            ->get();

        $hutangs = Hutang::where('nama', 'like', "%$query%")
            ->orWhere('jumlah', 'like', "%$query%")
            ->orWhere('catatan', 'like', "%$query%")
            ->orWhere('tgl_hutang', 'like', "%$query%")
            ->orWhere('tgl_jthtempo', 'like', "%$query%")
            ->get();

        $piutangs = Piutang::where('nama', 'like', "%$query%")
            ->orWhere('jumlah', 'like', "%$query%")
            ->orWhere('catatan', 'like', "%$query%")
            ->orWhere('tgl_piutang', 'like', "%$query%")
            ->orWhere('tgl_jthtempo', 'like', "%$query%")
            ->get();

        $rencanas = Rencana_budget::where('nama', 'like', "%$query%")
            ->orWhere('jumlah', 'like', "%$query%")
            ->orWhere('event', 'like', "%$query%")
            ->orWhere('katagori', 'like', "%$query%")
            ->get();

        $assets = Asset::where('nama', 'like', "%$query%")
            ->orWhere('harga', 'like', "%$query%")
            ->orWhere('keterangan', 'like', "%$query%")
            ->orWhere('tanggal', 'like', "%$query%")
            ->get();

        return response()->json([
            'pemasukans' => $pemasukans,
            'pengeluarans' => $pengeluarans,
            'hutangs' => $hutangs,
            'piutangs' => $piutangs,
            'rencanas' => $rencanas,
            'assets' => $assets,
            // Tambahkan hasil pencarian dari model-model lain
        ]);
    }

}
