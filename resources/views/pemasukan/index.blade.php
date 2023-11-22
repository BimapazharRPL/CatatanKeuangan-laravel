
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Input</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
</head>
@extends('layouts.master')
@section('content')
<body>

    
<div class="ab">
<h1>Pemasukan</h1>

<a href="{{ route('pemasukan.create') }}" class="btn btn-primary mb-3">+ Create New pemasukan</a>
<table class="table table-head-fixed text-nowrap">
   
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Catatan</th>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    
        @forelse ($pemasukans as $key => $pemasukan)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $pemasukan->nama }}</td>
            <td>{{ $pemasukan->jumlah }}</td>
            <td>{{ $pemasukan->catatan }}</td>
            <td>{{ $pemasukan->tanggal }}</td>
            <td>{{ $pemasukan->katagori }}</td>
            <td>
                <!-- <a href="{{ route('pemasukan.show', $pemasukan->id) }}" class="btn btn-sm btn-info">Show</a> -->
                <a href="{{ route('pemasukan.edit', $pemasukan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('pemasukan.destroy', $pemasukan->id) }}" method="POST" style="display: inline-block;">
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
            font-family: monospace;
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

        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        /* .btn:hover {
            color: #fff;
            text-decoration: none;
            background-color: #138496;
            border-color: #117a8b;
        } */


        .text-center {
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
        
        
        .ab {
            margin: 7rem -17rem;
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
    
    }

    
    </style>
    
</body>
</html>
@endsection
    