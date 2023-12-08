<!-- resources/views/export.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.7.4/jspdf.plugin.autotable.min.js"></script> -->
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Print</title>
    <link rel="icon" type="image/png" href="{{ asset('gambar/logoku.png') }}">
</head>
@extends('layouts.master')

@section('content')
<body>
    <div class="kuasa">
        <a href="printPemasukan" class="cetk"><i data-feather="printer"></i><br>Print data <br>Pemasukan</a>
        <a href="printPengeluaran" class="cetk"><i data-feather="printer"></i><br>Print data <br>Pengeluaran</a>
        <a href="printHutang" class="cetk"><i data-feather="printer"></i><br>Print data <br>Hutang</a>
        <a href="printPiutang" class="cetk"><i data-feather="printer"></i><br>Print data <br>Piutang</a>
        <a href="printLaporan" class="cetk"><i data-feather="printer"></i><br>Print data <br>Laporan</a>
        <a href="printRencana" class="cetk"><i data-feather="printer"></i><br>Print data <br>Rencana budget</a>
        <a href="printAset" class="cetk"><i data-feather="printer"></i><br>Print data <br>Asset</a>
        <a href="printKatagori" class="cetk"><i data-feather="printer"></i><br>Print data <br>Kategori</a>
        <a href="printHari" class="cetk"><i data-feather="printer"></i><br>Print data <br>Perhari</a>
        <a href="printMinggu" class="cetk"><i data-feather="printer"></i><br>Print data <br>Perminggu</a>
        <a href="printBulan" class="cetk"><i data-feather="printer"></i><br>Print data <br>Perbulan</a>
        <a href="printTahun" class="cetk"><i data-feather="printer"></i><br>Print data <br>Pertahun</a>
    </div>
</body>

<script>
    feather.replace();
</script>

<style>
    .kuasa {
        width: 58.8rem;
        margin: 8rem auto; /* Diganti menjadi "auto" agar pusat */
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .cetk {
        display: inline-block;
        text-decoration: none;
        background-color: #2c3e50; /* Warna latar belakang saat dihover */
        color: #fff; /* Warna teks saat dihover */
        padding: 15px 20px;
        font-weight: bold;
        margin: 10px;
        border: solid 2px none;
        border-radius: 5px;
        text-align: center;
        transition: background-color 0.3s, color 0.3s;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Ganti dengan font yang diinginkan */
    }

    .cetk:hover {
         /* Warna teks saat dihover */
         box-shadow: 10px 10px 10px rgba(0, 0, 0, 3);   
     }

     @media only screen and (max-width: 768px) {
        /* Gaya responsif untuk perangkat ponsel dengan lebar maksimum 768px */
        .kuasa {
         width: 27rem;
         margin: 3rem -15.7rem;
        }
        .cetk {
            width: 40%; 
            box-sizing: border-box; 
        }
    }
</style>

</html>
@endsection
