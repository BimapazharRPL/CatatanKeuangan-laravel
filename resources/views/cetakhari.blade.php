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
@foreach($groupedData as $tanggal => $data)
            @php
                $totalPemasukan = 0;
                $totalPengeluaran = 0;
            @endphp
            <thead>
            <tr>
                <th colspan="3" style="text-align: center;">{{ $tanggal }} {{ $totals[$tanggal]['hari'] }}</th>
                <!-- <th>{{ $totals[$tanggal]['hari'] }}</th> -->
                <!-- <td>
                    @foreach($data as $item)
                        @if($item->model == 'Pemasukan')
                            @php
                                $totalPemasukan += $item->jumlah;
                            @endphp
                        @endif
                    @endforeach
                    {{ $totalPemasukan }}
                </td>
                <td>
                    @foreach($data as $item)
                        @if($item->model == 'Pengeluaran')
                            @php
                                $totalPengeluaran += $item->jumlah;
                            @endphp
                        @endif
                    @endforeach
                    {{ $totalPengeluaran }}
                </td> -->
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr> 
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->katagori }}</td>
                    <td style="color: {{ get_class($item) == 'App\Models\Pengeluaran' ? 'red' : 'black' }}">
                    {{ $item->jumlah }}</td>
                </tr>
            @endforeach
        @endforeach
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