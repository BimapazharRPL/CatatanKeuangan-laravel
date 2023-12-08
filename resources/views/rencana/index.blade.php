
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rencana budget</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
</head>
@extends('layouts.master')
@section('content')
<body>
<?php
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Rencana_budget;

$data1 = Pemasukan::all();
$totalPemasukan = 0;

$data2 = Pengeluaran::all();
$totalPengeluaran = 0;

foreach ($data1 as $item1) {
    $totalPemasukan += $item1->jumlah;
}

foreach ($data2 as $item2) {
    $totalPengeluaran += $item2->jumlah;
}

// Integrasi dengan model Rencana_budget
$rencanaBudgets = Rencana_budget::all();

foreach ($rencanaBudgets as $rencana) {
    if ($rencana->katagori === 'Pemasukan') {
        $totalPemasukan += $rencana->jumlah;
    } elseif ($rencana->katagori === 'Pengeluaran') {
        $totalPengeluaran += $rencana->jumlah;
    }
}

$sisa = $totalPemasukan - $totalPengeluaran;
        
?>
<div class="kuasa">
<table class="data-table">
<thead>
    <tr>
        <th>Pemasukan</th>
        <th>Pengeluaran</th>
        <th>Saldo</th>
                  
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
    
<div class="ab">
    
<h1>Rencana budget</h1>

<a href="{{ route('rencana.create') }}" class="btn btn-primary mb-3">+ Create New rencana</a>
<table class="table table-head-fixed text-nowrap">
   
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Event</th>
            <th>Kategori</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    
        @forelse ($rencana_budgets as $key => $rencana)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $rencana->nama }}</td>
            <td>{{ $rencana->jumlah }}</td>
            <td>{{ $rencana->event }}</td>
            <td>{{ $rencana->katagori }}</td>
            <td>
                <!-- <a href="{{ route('rencana.show', $rencana->id) }}" class="btn btn-sm btn-info">Show</a> -->
                <a href="{{ route('rencana.edit', $rencana->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('rencana.destroy', $rencana->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
       
        @empty
        <tr>
            <td colspan="8" style="text-align: center;" >Data Masih Kosong</td>
        </tr>
        @endforelse
    </tbody>
    
</table>
</div>
</div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: aqua;
            margin: 0;
            padding: 0;
        }

        .ab {
            width: 58.2rem;
            height: 12rem;
            padding-bottom: 200rem;
            margin: 60px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }


        h1 {
            color: #333;
            font-family: Candara;
        }

        a {
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            color: #000;
            background-color: aqua;
        }

        .btn-primary:hover {
            background-color: #267b81;
            color: #ffff;
        }

        .table {
            width: 58.2rem;
            background-color: #fff;
            padding-left: 20rem;
            border-collapse: collapse;
            border-radius: 10px;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: aqua;
            color: #000;
        }

        tr:hover {
            background-color: #f5f5f5;
            border-radius: 10px;
        }

        .btn-warning {
            color: #fff;
            background-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #d39e00;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        .text-center {
            text-align: center;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 3rem 0 -5rem 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .data-table th {
            background-color: #ffff;
            color: black;
            
        }

        .data-table td {
            background-color: #f1f2ff;
            color: #000000;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        @media only screen and (max-width: 600px) {
        
        
        .ab {
            margin: -3.8rem -17rem;
            width: 27rem;
            padding: 8px;
        }
        .table {
            width: 100%; /* Lebar penuh untuk tampilan mobile */
            padding-left: 0; /* Padding dihapus untuk tampilan mobile */
        }

        th, td {
            padding: 8px; /* Padding yang lebih kecil untuk tampilan mobile */
            font-size: 12px; /* Ukuran font yang lebih kecil untuk tampilan mobile */
        }

        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.875rem;
        }
        .data-table {
                width: 27rem;
                margin: 3rem -15.7rem;
            }
    
    }
    </style>
   
</body>


</html>
@endsection
    