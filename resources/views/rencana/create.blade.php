<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<div class="container">
    <form method="POST" action="{{ route('rencana.store') }}">
    @csrf
    <div>
        <label for="nama">Nama :</label>
        <input type="text" id="nama" name="nama" placeholder="input nama rencana" required>
        </div>
    <div>
        <label for="jumlah">Jumlah :</label>
        <input type="number" id="jumlah" name="jumlah" placeholder="input jumlah" required>
        </div>
        <div>
        <label for="event">Event :</label>
        <input type="text" id="event" name="event" required>
        </div>
        <div>
        <label for="katagori">katagori :</label>
        <select name="katagori" id="katagori" required>
        <option value="Pemasukan">Pemasukan</option>   
        <option value="Pengeluaran">Pengeluaran</option>
        </select>
        </div>

        <button type="submit">Tambahkan data</button>
</div> </form><button id="closeButton">Close</button>
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
            margin: 8rem auto;
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
            display: flex;
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
            margin: -7rem 25rem;
        }
        @media only screen and (max-width: 600px) {
            .container {
            margin: 5rem auto;
            }
            #closeButton {
            margin: -4rem 6rem;
            }
        }
</style>
<script>
        
        function closeView() {
    
            window.history.back();
        }

        // Tambahkan event listener untuk tombol Close
        document.getElementById('closeButton').addEventListener('click', closeView);
    </script>
</html>