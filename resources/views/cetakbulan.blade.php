<?php
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Ambil data pengeluaran
$pengeluaranData = DB::table('pengeluarans')
    ->selectRaw('MONTH(tanggal) as bulan, SUM(jumlah) as total_pengeluaran')
    ->groupBy('bulan');

// Ambil data pemasukan
$pemasukanData = DB::table('pemasukans')
    ->selectRaw('MONTH(tanggal) as bulan, SUM(jumlah) as total_pemasukan')
    ->groupBy('bulan');

// Ambil data bulanan untuk pengeluaran
$monthlyDataPengeluaran = $pengeluaranData->get();

// Ambil data bulanan untuk pemasukan
$monthlyDataPemasukan = $pemasukanData->get();

// Ubah angka bulan menjadi nama bulan
$allMonths = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
];

// Buat struktur data yang lengkap untuk setiap bulan
$completeData = [];
foreach ($allMonths as $monthNumber => $monthName) {
    $completeData[] = [
        'bulan' => $monthName,
        'total_pemasukan' => $monthlyDataPemasukan->where('bulan', $monthNumber)->first()->total_pemasukan ?? 0,
        'total_pengeluaran' => $monthlyDataPengeluaran->where('bulan', $monthNumber)->first()->total_pengeluaran ?? 0,
    ];
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
<div style="width:98%; height:500px;">
    <canvas id="myChart"></canvas>
</div>
<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
    @if (!empty($completeData))
        @foreach($completeData as $data)
            <tr>
                <td>{{ $data['bulan'] }}</td>
                <td>{{ $data['total_pemasukan'] }}</td>
                <td>{{ $data['total_pengeluaran'] }}</td>
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
    // Mendapatkan data dari server
    var data = {!! json_encode($completeData) !!};
    var labels = data.map(item => item.bulan);
    var totalPemasukan = data.map(item => item.total_pemasukan);
    var totalPengeluaran = data.map(item => item.total_pengeluaran);

    // Menggambar grafik menggunakan data yang diambil
    var ctx = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Pemasukan per Bulan',
                    data: totalPemasukan,
                    backgroundColor: '#2c3e50',
                    borderColor: 'black',
                    borderWidth: 1
                },
                {
                    label: 'Total Pengeluaran per Bulan',
                    data: totalPengeluaran,
                    backgroundColor: 'rgba(255, 0, 0, 0.6)',
                    borderColor: 'red',
                    borderWidth: 1
                }
            ]
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
