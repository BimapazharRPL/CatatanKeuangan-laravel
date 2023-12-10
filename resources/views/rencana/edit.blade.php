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
    <form method="POST" action="{{ route('rencana.update' , $rencana->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label for="nama">Nama :</label>
        <input type="text" id="nama" name="nama" placeholder="input nama rencana" value="{{ old('nama') ?? $rencana->nama }}" required>
        </div>
    <div>
        <label for="jumlah">Jumlah :</label>
        <input type="number" id="jumlah" name="jumlah" placeholder="input jumlah" value="{{ old('jumlah') ?? $rencana->jumlah }}" required>
        </div>
        <div>
        <label for="event">Event :</label>
        <input type="text" id="event" name="event" value="{{ old('event') ?? $rencana->event }}" required>
        </div>
        <div>
        <label for="katagori">katagori :</label>
        <select name="katagori" id="katagori" required>
            <option value="Pemasukan" {{ (old('katagori') ?? $rencana->katagori) == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>   
            <option value="Pengeluaran" {{ (old('katagori') ?? $rencana->katagori) == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
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
            margin: 5rem auto;
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
            margin: 1rem 2rem;
        }
        @media only screen and (max-width: 600px) {
            .container {
            margin: 5rem auto;
            }
            #closeButton {
                
            margin: 0.5rem 1rem;
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