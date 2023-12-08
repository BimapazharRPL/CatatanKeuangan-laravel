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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Perbulan</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- <script src="{{ asset('js/custom.js') }}" defer></script> -->
</head>
@extends('layouts.master')
@section('content')
<body>
    <div class="kuasa">
    <div style="width:98%; height:500px;">
    <canvas id="mychart"></canvas>
</div>
<!-- <label for="tahun">Pilih Tahun:</label>
    <select id="tahun" name="tahun">
        @foreach(range(date('Y'), 2020, -1) as $year)
            <option value="{{ $year }}">{{ $year }}</option>
        @endforeach
    </select>
    <button onclick="changeYear()">Ganti Tahun</button> -->
<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
    @if (!empty($dataPerBulan))
    @foreach($dataPerBulan as $data)
            <tr>
                <td>{{ $data['bulan'] }}</td>
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
    .kuasa {
        width: 60rem;
        margin: 3rem 1rem;
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

    tr:hover {
        background-color: #e0e0e0;
    }
    @media only screen and (max-width: 600px) {
            .kuasa {
                width: 27rem;
                margin: 3rem -15.5rem;
            }
            canvas {
                width: 100%;
                /* margin: 3rem -8rem; */
            }
            table {
                margin-top: -16rem;
            }
        }
</style>
<script>
    // Mendapatkan data dari server
    var data = {!! json_encode($completeData) !!};
    var labels = data.map(item => item.bulan);
    var totalPemasukan = data.map(item => item.total_pemasukan);
    var totalPengeluaran = data.map(item => item.total_pengeluaran);

    // Menggambar grafik menggunakan data yang diambil
    var ctx = document.getElementById('mychart').getContext('2d');

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


    // function changeYear() {
    //     // Mendapatkan tahun yang dipilih dari elemen select
    //     var selectedYear = document.getElementById('tahun').value;

    //     // Mengirim permintaan ke server untuk mendapatkan data baru
    //     fetch(`/data-perbulan?tahun=${selectedYear}`)
    //         .then(response => response.json())
    //         .then(data => {
    //             // Memperbarui data dan menggambar grafik
    //             updateChartData(data);
    //         });
    // }

    // function updateChartData(data) {
    //     // Memperbarui data dari server
    //     var labels = data.map(item => item.bulan);
    //     var totalPemasukan = data.map(item => item.total_pemasukan);
    //     var totalPengeluaran = data.map(item => item.total_pengeluaran);

    //     // Memperbarui grafik
    //     myChart.data.labels = labels;
    //     myChart.data.datasets[0].data = totalPemasukan;
    //     myChart.data.datasets[1].data = totalPengeluaran;
    //     myChart.update();

    //     // Memperbarui tabel
    //     updateTableData(data);
    // }

    // function updateTableData(data) {
    //     // Menghapus semua baris tabel
    //     var tableBody = document.querySelector('table tbody');
    //     tableBody.innerHTML = '';

    //     // Memasukkan data baru ke dalam tabel
    //     data.forEach(item => {
    //         var row = tableBody.insertRow();
    //         var cell1 = row.insertCell(0);
    //         var cell2 = row.insertCell(1);
    //         var cell3 = row.insertCell(2);

    //         cell1.innerHTML = item.bulan;
    //         cell2.innerHTML = item.total_pemasukan ?? 0;
    //         cell3.innerHTML = item.total_pengeluaran ?? 0;
    //     });
    // }
</script>



</html>
@endsection
