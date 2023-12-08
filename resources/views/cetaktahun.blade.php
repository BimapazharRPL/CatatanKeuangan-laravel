<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
</head>
<body>
<table class="tabelprint">
<thead>
        <tr>
            <th>Tahun</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
    @if (!empty($dataPerTahun))
    @foreach($dataPerTahun as $data)
            <tr>
                <td>{{ $data['tahun'] }}</td>
                <td>{{ $data['total_pemasukan'] ?? 0 }}</td>
                <td>{{ $data['total_pengeluaran'] ?? 0 }}</td>
            </tr>
        @endforeach
        @else
            <tr>
            <td colspan="3" class="text-center">Data Masih Kosong</td>
            </tr>
            @endif
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