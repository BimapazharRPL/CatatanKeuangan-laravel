
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Perbulan</title>
    <link rel="icon" type="image/png" href="gambar/logoku.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- <script src="{{ asset('js/custom.js') }}" defer></script> -->
</head>
@extends('layouts.master')
@section('content')
<body>
    <div class="kuasa">
    <form id="yearForm">
        <label for="year">Pilih Tahun: </label>
        <select id="year" name="year">
            <!-- Tambahkan opsi tahun, misalnya dari tahun 2021 hingga tahun sekarang -->
            @for ($i = date('Y'); $i >= 2021; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button type="button" onclick="updateChart()">Ganti Tahun</button>
    </form>
    <div style="height: 30rem;">
        <canvas id="barChart"></canvas></div>
    </div>
</body>
<style>
    .kuasa {
        width: 60rem;
        margin: 3rem 1rem;
    }
    @media only screen and (max-width: 600px) {
            .kuasa {
                width: 27rem;
                margin: 3rem -15.5rem;
            }
            canvas {
                width: 100%;
                /* margin: 3rem -8rem; */
            }
        }
</style>

<script>

var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })        

        // document.addEventListener('DOMContentLoaded', function () {
        //     var pengeluaranData = @json($pengeluaranData);
        //     var pemasukanData = @json($pemasukanData);
        //     console.log(pemasukanData);

        //     // Menggunakan moment.js untuk mengubah angka bulan menjadi nama bulan
        //     var labels = moment.months();
        //     var currentYear = moment().year();

        //     var datasets = [
        //         {
        //             label: 'Pengeluaran',
        //             backgroundColor: 'rgba(255, 99, 132, 0.5)',
        //             borderColor: 'rgb(255, 99, 132)',
        //             borderWidth: 1,
        //             data: initializeDataArray(),
        //         },
        //         {
        //             label: 'Pemasukan',
        //             backgroundColor: 'rgba(75, 192, 192, 0.5)',
        //             borderColor: 'rgb(75, 192, 192)',
        //             borderWidth: 1,
        //             data: initializeDataArray(),
        //         },
        //     ];

        //     // Mengisi array data berdasarkan data yang diterima dari server
        //     pengeluaranData.forEach(function (item) {
        //         var index = moment.months().indexOf(item.tanggal);
        //         datasets[0].data[index] = item.total || 0;
        //     });

        //     pemasukanData.forEach(function (item) {
        //         var index = moment.months().indexOf(item.tanggal);
        //         datasets[1].data[index] = item.total || 0;
        //     });

        //     function initializeDataArray() {
        //         return Array(labels.length).fill(0);
        //     }

        //     var data = {
        //         labels: labels,
        //         datasets: datasets,
        //     };

        //     var options = {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         scales: {
        //             x: {
        //                 beginAtZero: true,
        //             },
        //             y: {
        //                 beginAtZero: true,
        //             },
        //         },
        //     };

        //     var ctx = document.getElementById('barChart').getContext('2d');
        //     var myBarChart = new Chart(ctx, {
        //         type: 'bar',
        //         data: data,
        //         options: options,
        //     });

        //     function updateChart() {
        //         // Ambil tahun yang dipilih oleh pengguna
        //         var selectedYear = document.getElementById('year').value;

        //         // Lakukan permintaan AJAX atau sesuaikan sumber data sesuai dengan tahun yang dipilih
        //         // ...

        //         // Setelah mendapatkan data yang baru, perbarui dataset dan chart
        //         // ...

        //         // Contoh: Hanya memberi tahu bahwa Anda perlu memperbarui dataset dan memanggil update
        //         console.log('Update chart for year ' + selectedYear);
        //     }

        //     window.updateChart = updateChart;
        // });
    </script>
</html>
@endsection
