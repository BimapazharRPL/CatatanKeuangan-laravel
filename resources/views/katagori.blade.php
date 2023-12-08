<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
</head>
@extends('layouts.master')
@section('content')
<body>
    <div class="kuasa">
    @if(count($groupedData) > 0)
<table class="data-table">
    <thead>
    @foreach($groupedData as $kategori => $data)
        <tr>
            <th colspan="4" style="text-align: center; background-color: aqua;">{{ $kategori }}</th>
        </tr>
        <tr>
            <th> Nama </th>
            <th> Jumlah </th>
            <th> Catatan</th>
            <th> Tanggal </th>
        </tr>
    </thead>
    <tbody>
         @foreach($data as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->catatan }}</td>
                <td>{{ $item->tanggal }}</td>
                @endforeach  <br>
            </tr>
        @endforeach
    </tbody>
</table>
@else
            <h3>Belum ada data</h3>
        @endif
    </div>
</body>
<style>
    .kuasa {
        margin: 3rem 2rem;
        width: 58.8rem;
    }
    .data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    .data-table th, .data-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .data-table th {
        background-color: #f1f1f1;
        text-align: center;
    }

    .data-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .data-table tbody tr:hover {
        background-color: #e0e0e0;
    }

    h3 {
        color: #a2a5a6;
        margin-top: 12rem;
    }

     @media only screen and (max-width: 600px) {
        .kuasa {
        margin: 1rem -16rem;
        width: 26rem;
    }
        .data-table {
            width: 100%;
        }
        .data-table th, .data-table td {
            
            width: 100%;
            box-sizing: border-box;
        }

        .data-table th {
            text-align: center;
            width: 100%;
        }

        .data-table tbody tr {
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
    }
</style>
</html>
@endsection