<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    <title>Data Perminggu</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
</head>
@extends('layouts.master')
@section('content')
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
<body>
    <div class="kuasa">
    <div style="width:98%; height:500px;">
    <canvas id="myChart"></canvas>
</div>
<table class="tabel">
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

    </div>
</body>
<style>
     body {
            margin: 0;
            padding: 0;
        }
    .kuasa {
        margin: 3rem 2rem ;
        width: 58.8rem;
    }
    canvas {
                    background-color: #ffff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                    max-width: 100%;
                    margin-top: 1rem;
                    width: 700rem;
                    height: auto;
                }
    .tabel {
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

    tr:hover {
        background-color: #e0e0e0;
    }
   
    @media only screen and (max-width: 600px) {
            .kuasa {
                width: 27rem;
                margin: 3rem -15.7rem;
                
            }
            canvas {
                margin-right: -9rem;
            }
            .tabel {
                margin-top: -10rem;
            }
        }
</style>
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
</script>



<!-- <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $weeklyData->keys() !!},
            datasets: [{
                label: 'Total Pengeluaran per Minggu',
                data: {!! $weeklyData->values() !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> -->

</html>
@endsection