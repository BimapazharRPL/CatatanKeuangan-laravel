<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Asset</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
</head>
@extends('layouts.master')
@section('content')
<body>
<div class="kuasa">
    <h2>Asset</h2>
    <table class="table">
    <thead>
        <tr>
            <th>Nama Asset</th>
            <th>Harga Asset</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($beliAssetData as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>Rp. {{ $item->jumlah }}</td>
                <td>{{ $item->catatan }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Data Masih Kosong</td>
            </tr>
        @endforelse
    </tbody>
</table>

  </div>
</body>
<style>
    body {
        background-color: #f1f1f1;
    }
    .kuasa {
        width: 58.8rem;
        margin :4rem 2rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: center;
        color: #333;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: aqua;
        font-weight: bold;
        color: #000000;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    tbody td {
        color: #222222;
    }
    @media only screen and (max-width: 600px) {
            .kuasa {
                width: 28.5rem;
                margin: 3rem -16.4rem;
            }
        }
    
</style>
</html>
@endsection
