
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Perhari</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
</head>
@extends('layouts.master')
@section('content')
<body>
    <div class="am">
    @if(count($groupedData) > 0)
    <table class="data-table">
    <!-- <thead>
        <tr>
            <th>Tanggal</th>
            <th>Hari</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead> -->
        @foreach($groupedData as $tanggal => $data)
            @php
                $totalPemasukan = 0;
                $totalPengeluaran = 0;
            @endphp
            <thead>
            <tr>
            <th colspan="3" style="text-align: center;">
    @php
        $namaHari = $totals[$tanggal]['hari'];
        $tanggalObj = \DateTime::createFromFormat('Y-m-d', $tanggal);
        $formattedDate = $tanggalObj->format('d M Y');
        
        switch ($namaHari) {
            case 'Monday':
                echo 'Senin';
                break;
            case 'Tuesday':
                echo 'Selasa';
                break;
            case 'Wednesday':
                echo 'Rabu';
                break;
            case 'Thursday':
                echo 'Kamis';
                break;
            case 'Friday':
                echo 'Jum\'at';
                break;
            case 'Saturday':
                echo 'Sabtu';
                break;
            case 'Sunday':
                echo 'Minggu';
                break;
            default:
                echo $namaHari; // Jika tidak cocok, tampilkan nilai aslinya
        }
    @endphp
    {{ $formattedDate }}
</th>


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
@else
            <h3>Belum ada data</h3>
        @endif

</div>
</body>
<style>
    .am {
        width: 58.8rem;
        margin: 5rem 0 ;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
       
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .data-table th, .data-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .data-table thead {
        background-color: aqua;
    }

    .data-table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .data-table th {
        background-color: aqua;
        color: black;
    }

    h3 {
        color: #a2a5a6;
        margin-top: 12rem;
    }

    @media only screen and (max-width: 600px) {
        .am {
        margin: 4rem -16rem;
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