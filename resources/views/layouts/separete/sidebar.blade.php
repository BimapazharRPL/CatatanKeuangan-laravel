<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="pemasukan">Pemasukan</a></li>
            <li><a href="pengeluaran">Pengeluaran</a></li>
            <li><a href="laporan">Laporan</a></li>
            <li><a href="hutang">Hutang</a></li>
            <li><a href="piutang">Piutang</a></li>
            <li><a href="rencana">Rencana Budget</a></li>
            <li><a href="katagori">Kategori</a></li>
            <li><a href="asset">Asset</a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
        </ul>
    </div>
    <button class="KL" onclick="toggleSidebar()">MENU<br>LAIN</button>
    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
    text-align: center;
    }

    .sidebar {
        margin-top: 6rem;
        width: 14rem;
        height: 100vh;
        background-color: black;
        position: fixed;
        font-family: cursive;
        /* font-size: 1.5rem; */
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar ul li {
        padding: 0.8rem;
        
    }

    .sidebar ul li a:hover {
        background-color: #ffff;
        color: #000;
        padding: 1rem 2rem;
        border-radius: 1rem;
        font-family: serif;

    }

    .sidebar ul li a {
        text-decoration: none;
        color: #ffff;
        cursor: pointer;
        padding: 1rem 2.3rem;
    }
    /* button{
        display: none;
    } */
    /* Media Query untuk tampilan mobile */
    @media only screen and (max-width: 600px) {
        .sidebar {
            width: 40%;
            margin-top: 6rem;
            z-index: 99999;
            display: none;
         }

        .sidebar.show {
            display: block;
         }

        .sidebar ul li a:hover {
            padding: 1rem 1.5rem;
        }

        .sidebar ul li a {
            padding: 0.1rem 0.1rem;
        }
        .KL {
            height: 4rem;
            margin-top: 8rem;
            position: fixed;
            font-size: 0.7rem;
            font-weight: bold;
            border-radius :0px 13px 13px 0px;
            border: none; 
            cursor: pointer;
            background-color: #000;
            color: white; 
        }
        .KL:hover {
            color: #000;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    }

    @media only screen and (min-width: 768px) {
  
   .KL {
        display: none;
        }
    }
    </style>
     <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
    </script>
</body>
</html>
