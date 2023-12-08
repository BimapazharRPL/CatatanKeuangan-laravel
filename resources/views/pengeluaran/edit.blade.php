<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Edit</title>
    <link rel="icon" type="image/png" href="{{ asset('gambar/logoku.png') }}">
</head>
<body>
<div class="container">
    <form method="POST" action="{{ route('pengeluaran.update' , $pengeluaran->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label for="nama">Nama :</label>
        <input type="text" id="nama" name="nama" placeholder="input nama pengeluaran" value="{{ old('nama') ?? $pengeluaran->nama }}" required>
        </div>
    <div>
        <label for="jumlah">Jumlah :</label>
        <input type="number" id="jumlah" name="jumlah" placeholder="input jumlah" value="{{ old('jumlah') ?? $pengeluaran->jumlah }}" required>
        </div>
        <div>
        <label for="catatan">Catatan :</label>
        <textarea name="catatan" id="catatan" cols="20" rows="5" required>{{ old('catatan') ?? $pengeluaran->catatan }}</textarea>
        </div>
        <div>
        <label for="tanggal">Tanggal :</label>
        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') ?? $pengeluaran->tanggal }}" required>
        </div>
        <div>
        <label for="katagori">katagori :</label>
        <select name="katagori" id="katagori" value="{{ old('katagori') ?? $pengeluaran->katagori }}" required>
        <option value="Kebutuhan pokok">Kebutuhan pokok</option>   
        <option value="Biaya">Biaya</option>
        <option value="Kerugian">Kerugian</option>
        <option value="Beli asset">Beli asset</option>
        <option value="Pajak">Pajak</option>
        <option value="Tagihan">Tagihan</option>
        <option value="Transportasi">Transportasi</option>
        <option value="Hiburan">Hiburan</option>
        <option value="Belanja">Belanja</option>
        <option value="Lainnya">Lainnya</option>
        </select>
        </div>

        <button type="submit">Update data</button>
    </form><button id="closeButton">Close</button>
</div>
</body>
<style>
    body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 1rem auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: aqua;
            color: #000;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }

        button:hover {
            background-color: #267b81;
            color: #ffff;
        }
        #closeButton {
            margin-top: 2px;
        }
        @media only screen and (max-width: 600px) {
            .container {
            margin: 0.5rem auto;
        }
    }
</style>
<script>
        
        function closeView() {
            
            window.history.back();
        }
    
        document.getElementById('closeButton').addEventListener('click', closeView);
    </script>
</html>