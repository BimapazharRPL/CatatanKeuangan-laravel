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
    @if(Auth::check() && (Auth::user()->status == 'Bapak/Admin' || Auth::user()->status == 'Ibu/Anggota'))
<a href="{{ route('asset.create') }}" style="float: left" class="btn btn-primary mb-3">+ Create</a><br>
@endif
    @if ($beliAssetData->isEmpty() && $assets->isEmpty())
            <p>Data Masih Kosong</p>
        @else
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
               
            </tr>
        @endforelse
    </tbody>
    <tbody>
        @forelse($assets as $asset)
            <tr>
                <td>{{ $asset->nama }}</td>
                <td>Rp. {{ $asset->harga }}</td>
                <td>{{ $asset->keterangan }}</td>
                <td>{{ $asset->tanggal }}</td>
                
       </tr>
       @empty
       <tr>
          
       </tr>
       @endforelse
   </tbody>
</table>
@endif
<div class="yahh">

@if($assets->isNotEmpty())
<table class="kecil">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    
        @forelse ($assets as $key => $asset)
        <tr>
            <td style="padding: 5px;">{{ $key + 1 }}</td>
            <td style="padding: 5px;">{{ $asset->nama }}</td>
            <td style="padding: 5px;">
                <!-- <a href="{{ route('asset.show', $asset->id) }}" class="btn btn-sm btn-info">Show</a> -->
                @if(Auth::check() && (Auth::user()->status == 'Bapak/Admin' || Auth::user()->status == 'Ibu/Anggota'))
                <a href="{{ route('asset.edit', $asset->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('asset.destroy', $asset->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                @endif
            </td>
        </tr>
       
        @empty
        <tr>
        <td colspan="8" style="text-align: center;" >Data Masih Kosong</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif
</div>
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

    .yahh {
        width: 30%;
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
    a {
            text-decoration: none;
           
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
        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.875rem;
        }
        .kecil th {
            padding: 7px;
            border-bottom: 1px solid #ddd;
            
        }
    @media only screen and (max-width: 600px) {
            .kuasa {
                width: 28.5rem;
                margin: 3rem -16.4rem;
            }
            .yahh {
                width: 18rem;
                
            }
        }
    
</style>
</html>
@endsection
