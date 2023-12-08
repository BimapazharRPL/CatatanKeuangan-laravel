<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pengeluaran</title>
    <link rel="icon" type="image/png" href="{{ asset('gambar/logoku.png') }}">
</head>
<body>
    
<table>
<thead>
                <tr>
                    <th colspan="2" style="text-align: center; background-color: aqua;">Table Pengeluaran</th>
                    
            </thead>
    <tbody>
      <tr>
        <td>ID</td>
        <td>{{ $pengeluaran->id }}</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>{{ $pengeluaran->nama }}</td>
      </tr>
      <tr>
        <td>Jumlah</td>
        <td>{{ $pengeluaran->jumlah }}</td>
      </tr>
      <tr>
        <td>Catatan</td>
        <td>{{ $pengeluaran->catatan }}</td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td>{{ $pengeluaran->tanggal }}</td>
      </tr>
      <tr>
        <td>Kategori</td>
        <td>{{ $pengeluaran->katagori }}</td>
      </tr>
    </tbody>
  </table>
  <button id="closeButton">Close</button>
</body>
<script>
        
        function closeView() {
    
            window.history.back();
        }

        // Tambahkan event listener untuk tombol Close
        document.getElementById('closeButton').addEventListener('click', closeView);
    </script>
  <style>
    table {
      width: 90%;
      border-collapse: collapse;
      margin: 5rem auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }

    th {
      color: #000;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    #closeButton {
            margin: -3rem 18rem;
            background-color: aqua;
            color: #000;
            padding: 12px 20px;
            display: flex;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }
        #closeButton:hover {
            background-color: #267b81;
            color: #ffff;
        }
  </style>
</html>
