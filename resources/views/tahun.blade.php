<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Data Pertahun</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
</head>
@extends('layouts.master')
@section('content')
<body>
    <div class="av">
    <!-- <canvas id="myChart" width="400" height="200"></canvas> -->
    <table>
    <thead>
        <tr>
            <th>Tahun</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pemasukanTahun as $data)
            <tr>
                <td>{{ $data->tahun }}</td>
                <td>{{ $data->total_pemasukan }}</td>
                <td>{{ $pengeluaranTahun->where('tahun', $data->tahun)->first()->total_pengeluaran ?? 0 }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="text-align: center;">Data Masih Kosong</td>
            </tr>
        @endforelse
    </tbody>
</table>

    <!-- <table>
    <thead>
        <tr>
            <th>Tahun</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($pemasukanTahun))
        @foreach($pemasukanTahun as $data)
            <tr>
                <td>{{ $data->tahun }}</td>
                <td>{{ $data->total_pemasukan }}</td>
                <td>{{ $pengeluaranTahun->where('tahun', $data->tahun)->first()->total_pengeluaran ?? 0 }}</td>
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="8" style="text-align: center;" >Data Masih Kosong</td>
                <td>kosong</td>
                <td>kosong</td>
                <td></td>
            </tr>
        @endif
    </tbody>
</table> -->
</div>
</body>
<style>
    .av {
        width: 58.8rem;
        margin: 3rem 1rem;
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
            .av {
                width: 27rem;
                margin: 3rem -15.7rem;
            }
        }
</style>
</html>
<script>
      
    </script>

@endsection