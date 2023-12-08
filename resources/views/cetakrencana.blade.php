<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
</head>
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
<body>
<table class="tabelprint">
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
        <br> 
<table class="tabelprint">
<thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Event</th>
            <th>Kategori</th>
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
       </tr>
       @empty
       <tr>
           <td colspan="8" style="text-align: center;" >Data Masih Kosong</td>
       </tr>
       @endforelse
   </tbody>
   
</table>
<style>
   .tabelprint {
       width: 100%;
       border-collapse: collapse;
       margin-top: 20px;
   }

   .tabelprint th, .tabelprint td {
       border: 1px solid #ddd;
       padding: 8px;
       text-align: center;
   }

   .tabelprint th {
       background-color: #f2f2f2;
   }

   .tabelprint tbody tr:hover {
       background-color: #f5f5f5;
   }

   .tabelprint td:last-child {
       text-align: center;
   }

   .tabelprint td:last-child a {
       color: #3498db;
       margin: 0 5px;
   }

   .tabelprint td:last-child a:hover {
       text-decoration: underline;
   }
</style>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Print otomatis ketika halaman dimuat
        window.print();

        // Mendeteksi ketika cetakan selesai atau dibatalkan
        window.onafterprint = function (event) {
            // Kembali ke halaman sebelumnya jika cetakan berhasil
            window.history.back();
        };
    });
</script>