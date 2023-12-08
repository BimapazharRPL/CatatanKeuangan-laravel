<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
</head>
<body>
@if ($beliAssetData->isEmpty() && $assets->isEmpty())
            <p>Data Masih Kosong</p>
        @else
<table class="tabelprint">
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