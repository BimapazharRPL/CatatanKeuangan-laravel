<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
</head>
<body>
<h2 style="text-align: center;">Pengeluaran</h2>
<table class="tabelprint">
   
   <thead>
       <tr>
           <th>No</th>
           <th>Nama</th>
           <th>Jumlah</th>
           <th>Catatan</th>
           <th>Tanggal</th>
           <th>Kategori</th>
       </tr>
   </thead>
   <tbody>
   
   @forelse ($pengeluarans as $key => $pengeluaran)
       <tr>
           <td>{{ $key + 1 }}</td>
           <td>{{ $pengeluaran->nama }}</td>
           <td>{{ $pengeluaran->jumlah }}</td>
           <td>{{ $pengeluaran->catatan }}</td>
           <td>{{ $pengeluaran->tanggal }}</td>
           <td>{{ $pengeluaran->katagori }}</td>
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