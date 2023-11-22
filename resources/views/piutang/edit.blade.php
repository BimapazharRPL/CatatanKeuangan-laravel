<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<div class="container">
    <form method="POST" action="{{ route('piutang.update' , $piutang->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label for="nama">Nama :</label>
        <input type="text" id="nama" name="nama" placeholder="input nama piutang" value="{{ old('nama') ?? $piutang->nama }}" required>
        </div>
    <div>
        <label for="jumlah">Jumlah :</label>
        <input type="number" id="jumlah" name="jumlah" placeholder="input jumlah" value="{{ old('jumlah') ?? $piutang->jumlah }}" required>
        </div>
        <div>
        <label for="catatan">Catatan :</label>
        <textarea name="catatan" id="catatan" cols="20" rows="3" required>{{ old('catatan') ?? $piutang->catatan }}</textarea>
        </div>
        <div>
        <label for="tanggal">Tanggal :</label>
        <input type="date" id="tanggal" name="tgl_piutang" value="{{ old('tanggal') ?? $piutang->tgl_piutang }}" required>
        </div>
        <div>
        <label for="tanggaljht">Tanggal jatuh tempo:</label>
        <input type="date" id="tanggaljht" name="tgl_jthtempo" value="{{ old('tgl_jthtempo') ?? $piutang->tgl_jthtempo }}" required>
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
            margin: 2rem auto;
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
            margin: 0.1rem 2rem;
        }
        @media only screen and (max-width: 600px) {
            
            #closeButton {   
            margin: 0.1rem 2rem;
            }
            .container {
            margin: 1rem auto;
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