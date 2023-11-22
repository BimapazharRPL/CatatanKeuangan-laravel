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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

//  $pengeluaranData = Pengeluaran::all();
$pengeluaranData = DB::table('pengeluarans')->get();

$weeklyData = $pengeluaranData->groupBy(function ($date) {
    return Carbon::parse($date->tanggal)->format('W');
})->map(function ($group) {
    return $group->sum('jumlah');
});

?>
<body>
    <div class="kuasa">
    <div style="width:98%; height:500px;">
    <canvas id="myChart"></canvas>
</div>
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
   
    @media only screen and (max-width: 600px) {
            .kuasa {
                width: 27rem;
                margin: 3rem -15.7rem;
                
            }
            canvas {
                margin-right: -9rem;
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