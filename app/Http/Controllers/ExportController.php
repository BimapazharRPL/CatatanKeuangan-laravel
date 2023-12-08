<?php

namespace App\Http\Controllers;
// require_once 'vendor/autoload.php';


// Selanjutnya, Anda dapat menggunakannya untuk mengimpor kelas atau melakukan tugas lainnya

// use Mpdf\Mpdf;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Hutang;
use App\Models\Piutang;
use App\Models\Asset;
use App\Models\Rencana_budget;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;
// use Excel;

class ExportController extends Controller
{

    public function index()
    {
        return view('cetak');
    }

    public function printpemasukan()
    {
        $pemasukans = Pemasukan::all();
        return view('cetakpemasukan', compact('pemasukans'));
    }

    public function printpengeluaran()
    {
        $pengeluarans = Pengeluaran::all();
        return view('cetakpengeluaran', compact('pengeluarans'));
    }

    public function printhutang()
    {
        $hutangs = Hutang::all();
        return view('cetakhutang', compact('hutangs'));
    }

    public function printpiutang()
    {
        $piutangs = Piutang::all();
        return view('cetakpiutang', compact('piutangs'));
    }
    public function printlaporan()
    {
        return view('cetaklaporan');
    }
    public function printrencana()
    {
        $rencana_budgets = Rencana_budget::all();
        return view('cetakrencana', compact('rencana_budgets'));
    }
    public function printaset()
    {
        // Ambil data pengeluaran berdasarkan kategori 'Beli asset'
        $beliAssetData = Pengeluaran::where('katagori', 'Beli asset')->get();
        $assets = Asset::all();

        return view('cetakasset', compact('beliAssetData','assets'));
    }
    public function printkatagori()
    {
        // Mengambil data pemasukan dan pengeluaran
        $dataPemasukan = Pemasukan::all();
        $dataPengeluaran = Pengeluaran::all();

        // Menggabungkan data pemasukan dan pengeluaran
        $semuaData = $dataPemasukan->concat($dataPengeluaran);

        // Mengelompokkan data berdasarkan kategori
        $groupedData = $semuaData->groupBy('katagori');

        // Tampilkan data
        return view('cetakkatagori', compact('groupedData'));
    }
    public function printhari()
    {
        // Mengambil data pemasukan dan pengeluaran
        $dataPemasukan = Pemasukan::all();
        $dataPengeluaran = Pengeluaran::all();
    
        // Menggabungkan data pemasukan dan pengeluaran
        $semuaData = $dataPemasukan->concat($dataPengeluaran);
    
        // Mengelompokkan data berdasarkan tanggal
        $groupedData = $semuaData->groupBy('tanggal');
    
        // Menghitung total pemasukan dan pengeluaran per tanggal
        $totals = $groupedData->map(function ($item) {
            $totalPemasukan = $item->where('model', Pemasukan::class)->sum('jumlah');
            $totalPengeluaran = $item->where('model', Pengeluaran::class)->sum('jumlah');
    
            return [
                'hari' => Carbon::parse($item->first()->tanggal)->format('l'),
                'total_pemasukan' => $totalPemasukan,
                'total_pengeluaran' => $totalPengeluaran,
            ];
        });
    
        // Tampilkan data
        return view('cetakhari', compact('groupedData', 'totals'));
    }
    public function printminggu()
    {
        return view('cetakminggu');
    }

    public function printbulan(Request $request)
     {
        $pemasukanBulan = Pemasukan::selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, SUM(jumlah) as total_pemasukan')
            ->groupBy('tahun', 'bulan')
            ->get();

        $pengeluaranBulan = Pengeluaran::selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, SUM(jumlah) as total_pengeluaran')
            ->groupBy('tahun', 'bulan')
            ->get();

        $dataPerBulan = [];
        foreach ($pemasukanBulan as $pemasukan) {
            $tahun = $pemasukan->tahun;
            $bulan = $pemasukan->bulan;
            $dataPerBulan[$tahun . '-' . $bulan]['total_pemasukan'] = $pemasukan->total_pemasukan;
            $dataPerBulan[$tahun . '-' . $bulan]['tahun'] = $tahun;
            $dataPerBulan[$tahun . '-' . $bulan]['bulan'] = $bulan;
        }

        foreach ($pengeluaranBulan as $pengeluaran) {
            $tahun = $pengeluaran->tahun;
            $bulan = $pengeluaran->bulan;
            $dataPerBulan[$tahun . '-' . $bulan]['total_pengeluaran'] = $pengeluaran->total_pengeluaran;
            $dataPerBulan[$tahun . '-' . $bulan]['tahun'] = $tahun;
            $dataPerBulan[$tahun . '-' . $bulan]['bulan'] = $bulan;
        }
            return view('cetakbulan', compact('dataPerBulan'));

            }

    public function printtahun()
    {
        $pemasukanTahun = Pemasukan::selectRaw('YEAR(tanggal) as tahun, SUM(jumlah) as total_pemasukan')
        ->groupBy('tahun')
        ->get();

    $pengeluaranTahun = Pengeluaran::selectRaw('YEAR(tanggal) as tahun, SUM(jumlah) as total_pengeluaran')
        ->groupBy('tahun')
        ->get();

        $dataPerTahun = [];
        foreach ($pemasukanTahun as $pemasukan) {
            $dataPerTahun[$pemasukan->tahun]['total_pemasukan'] = $pemasukan->total_pemasukan;
            $dataPerTahun[$pemasukan->tahun]['tahun'] = $pemasukan->tahun;
        }

        foreach ($pengeluaranTahun as $pengeluaran) {
            $dataPerTahun[$pengeluaran->tahun]['total_pengeluaran'] = $pengeluaran->total_pengeluaran;
            $dataPerTahun[$pengeluaran->tahun]['tahun'] = $pengeluaran->tahun;
        }
    return view('cetaktahun', compact('dataPerTahun'));
     }
    // public function download_pdf()
    // {
    //     $mpdf = new \Mpdf\Mpdf();
    //     $mpdf->WriteHTML(view('cetak'));
    //     $mpdf->Output('download-pdf-laporan.pdf','D');
    // }

    // public function exportToExcel()
    // {
    //     $data = YourModel::all(); // Ganti dengan model dan data Anda

    //     return Excel::download(new YourExportClass($data), 'nama_file.xlsx');
    // }
}


