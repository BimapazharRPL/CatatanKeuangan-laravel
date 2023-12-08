<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    
<?php
use App\Models\Pengeluaran;
use App\Models\Pemasukan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

//  $pengeluaranData = Pengeluaran::all();
$pengeluaranData = DB::table('pengeluarans')->get();

$weeklyData = $pengeluaranData->groupBy(function ($date) {
    return Carbon::parse($date->tanggal)->format('W');
})->map(function ($group) {
    return $group->sum('jumlah');
});


$pemasukanMinggu = Pemasukan::selectRaw('YEAR(tanggal) as tahun, WEEK(tanggal) as minggu, SUM(jumlah) as total_pemasukan')
->groupBy('tahun', 'minggu')
->get();

// Menghitung total pengeluaran perminggu
$pengeluaranMinggu = Pengeluaran::selectRaw('YEAR(tanggal) as tahun, WEEK(tanggal) as minggu, SUM(jumlah) as total_pengeluaran')
->groupBy('tahun', 'minggu')
->get();

$dataPerMinggu = [];
foreach ($pemasukanMinggu as $pemasukan) {
    $dataPerMinggu[$pemasukan->minggu]['total_pemasukan'] = $pemasukan->total_pemasukan;
    $dataPerMinggu[$pemasukan->minggu]['minggu'] = $pemasukan->minggu;
}

foreach ($pengeluaranMinggu as $pengeluaran) {
    $dataPerMinggu[$pengeluaran->minggu]['total_pengeluaran'] = $pengeluaran->total_pengeluaran;
    $dataPerMinggu[$pengeluaran->minggu]['minggu'] = $pengeluaran->minggu;
}
?>
<div style="width:100%; height:500px;">
    <canvas id="myChart"></canvas>
</div>
<table>
    <thead>
        <tr>
            <th>Minggu</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
    @if (!empty($dataPerMinggu))
    @foreach($dataPerMinggu as $data)
            <tr>
                <td>{{ $data['minggu'] }}</td>
                <td>{{ $data['total_pemasukan'] ?? 0 }}</td>
                <td>{{ $data['total_pengeluaran'] ?? 0 }}</td>
            </tr>
        @endforeach
        @else
            <tr>
            <td colspan="3" class="text-center">Data Masih Kosong</td>
            </tr>
            @endif
    </tbody>
</table>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $weeklyData->keys() !!},
            datasets: [{
                label: 'Total Pengeluaran per Minggu',
                data: {!! $weeklyData->values() !!},
                backgroundColor: 'rgba(255, 0, 0, 0.6)',
                borderColor: 'red',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                zoom: {
                    pan: {
                        enabled: true,
                        mode: 'x',
                    },
                    zoom: {
                        enabled: true,
                        mode: 'x',
                    }
                }
            }
        }
    });

    // Tambahkan script print di bawah ini
    setTimeout(function () {
        window.print();
    }, 1000); // Tunggu 1 detik, bisa disesuaikan dengan kebutuhan

    // Mendeteksi ketika cetakan selesai atau dibatalkan
    window.onafterprint = function (event) {
        // Kembali ke halaman sebelumnya jika cetakan berhasil
        window.history.back();
    };
</script>

<style>
    canvas {
        margin: auto;
    }
     table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }

    th {
        background-color: aqua;
        color: black;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>


