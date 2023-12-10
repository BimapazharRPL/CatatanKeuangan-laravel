<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
@extends('layouts.master')
@section('content')

<body>
    
<div class="atas">
<table class="data-table">
    
<?php
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Hutang;
use App\Models\Piutang;

// Set zona waktu ke "Asia/Jakarta"
date_default_timezone_set('Asia/Jakarta');

$data1 = Pemasukan::all();
$totalPemasukan = 0;

$data2 = Pengeluaran::all();
$totalPengeluaran = 0;

$data3 = Hutang::all();
$totalHutang = 0;


$data4 = Piutang::all();
$totalPiutang = 0;

foreach ($data1 as $item1) {
    $totalPemasukan += $item1->jumlah;
}

foreach ($data2 as $item2) {
    $totalPengeluaran += $item2->jumlah;
}

$sisa = $totalPemasukan - $totalPengeluaran;
if ($sisa < 0) {
    $sisa = 0;
}

foreach ($data3 as $item3) {
    $totalHutang += $item3->jumlah;
}

foreach ($data4 as $item4) {
    $totalPiutang += $item4->jumlah;
}

$hari1 = date("Y-m-d");
        $hutangHariIni = [];
        $hutangHariInI = [];

        foreach ($data3 as $waktu) {
            if ($hari1 === $waktu->tgl_jthtempo) {
                // Jika tanggal hari ini sama dengan tanggal jatuh tempo
                // Simpan nama Hutang ke dalam array
                $hutangHariIni[] = [
                    'nama' => $waktu->nama,
                    'jumlah' => $waktu->jumlah,
                ];
            }
        } 

        foreach ($data4 as $waktu1) {
            if ($hari1 === $waktu1->tgl_jthtempo) {
                // Jika tanggal hari ini sama dengan tanggal jatuh tempo
                // Simpan nama Hutang ke dalam array
                $hutangHariInI[] = [
                    'nama' => $waktu1->nama,
                    'jumlah' => $waktu1->jumlah,
                ];
            }
        }
        
?>

            <thead>
                <tr>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                    <th>Sisa</th>
                  
                </tr>
            </thead>
            <tbody>
                <tr> 
                    <td>{{ $totalPemasukan }}</td>
                    <td>{{ $totalPengeluaran }}</td>
                    <td>{{ $sisa }}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
       
             <!-- <canvas id="pieChart"></canvas> -->
             <div style="height: 24rem;">
             <canvas id="pieChart"></canvas>
            </div>
             <br><br>
        <table class="data-table">
        <thead>
                <tr>
                    <th>Total Hutang</th>
                    <th>Total Piutang</th>
                </tr>
            </thead>
            <tbody>
                <tr> 
                    <td>{{ $totalHutang }}</td>
                    <td>{{ $totalPiutang }}</td>
                </tr>
            </tbody>
        </table><br><br>
        <table class="data-table">
        <thead>
                <tr>
                    <th>Hutang yang jatuh tempo</th>
                    <th>Jumlah yang akan dibayar</th>
                </tr>
            </thead>
            <tbody>
            @if (!empty($hutangHariIni))
            @foreach($hutangHariIni as $hutang)
                <tr> 
                    <td>{{ $hutang['nama'] }}</td>
                    <td>{{ $hutang['jumlah'] }}</td>
                </tr>
            @endforeach
            @else
            <tr>
                <td>Tidak ada</td>
                <td>Tidak ada</td>
            </tr>
            @endif

            </tbody>
        </table><br><br>
        <table class="data-table">
        <thead>
                <tr>
                    <th>Piutang yang jatuh tempo</th>
                    <th>Jumlah yang akan dibayar</th>
                </tr>
            </thead>
            <tbody>
            @if (!empty($hutangHariInI))
            @foreach($hutangHariInI as $hutangX)
                <tr> 
                    <td>{{ $hutangX['nama'] }}</td>
                    <td>{{ $hutangX['jumlah'] }}</td>
                </tr>
            @endforeach
            @else
            <tr>
                <td>Tidak ada</td>
                <td>Tidak ada</td>
            </tr>
            @endif

            </tbody>
        </table><br><br>
        
    
        </div>
    <style>
        .atas {
            width: 58.8rem;
            margin: 3rem 1rem;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .data-table th {
            background-color: aqua;
            color: black;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        canvas {
            background-color: #ffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);              max-width: 100%;
            margin-top: 1rem;
            width: 700rem;
            height: auto;
        }

        /* canvas {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 100%;
            margin-top: 1rem;
            width: 7rem;
            height: 7rem;
        } */

        @media only screen and (max-width: 600px) {
            .atas {
                width: 27rem;
                margin: 3rem -15.7rem;
            }
        }
    </style>
    </body>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Ambil total pengeluaran dan sisa dari PHP
    var totalPengeluaran = {{ $totalPengeluaran }};
    var sisa = {{ $sisa }};

    // Data untuk grafik Pie Chart
    var data = {
        labels: ['Pengeluaran', 'Sisa'],
        datasets: [{
            data: [totalPengeluaran, sisa],
            backgroundColor: ['#FF6384', '#FFCE56'],
        }]
    };

    // Konfigurasi untuk grafik
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false, // Menyembunyikan legend
        },
    };

    // Ambil elemen canvas
    var ctx = document.getElementById('pieChart').getContext('2d');

    // Buat grafik Pie Chart
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options,
    });
});
</script>
</html>
                    
@endsection