
<?php
use App\Models\Hutang;
use App\Models\Piutang;

$data3 = Hutang::all();
$data4 = Piutang::all();

$hari1 = date("Y-m-d");
        $hutangHariIni = [];
        $hutangHariInI = [];

        foreach ($data3 as $waktu) {
            if ($hari1 === $waktu->tgl_jthtempo) {
                // Jika tanggal hari ini sama dengan tanggal jatuh tempo
                // Simpan nama Hutang ke dalam array
                $hutangHariIni[] = [
                    'nama' => $waktu->nama,
                    'jumlah' => $waktu->jumlah,
                ];
            }
        } 

        foreach ($data4 as $waktu1) {
            if ($hari1 === $waktu1->tgl_jthtempo) {
                // Jika tanggal hari ini sama dengan tanggal jatuh tempo
                // Simpan nama Hutang ke dalam array
                $hutangHariInI[] = [
                    'nama' => $waktu1->nama,
                    'jumlah' => $waktu1->jumlah,
                ];
            }
        }
?>
<style>

</style>


<div class="header">
    <img src="gambar/logonama.png" alt="">
    
    <div class="ic">
    <img src="gambar/notip.png" id="showModalButton" title="notifikasi">
    <img src="gambar/icon profile.png" id="showModulButton" title="akun">
    </div>
</div>
<!-- resources/views/layouts/modal.blade.php -->

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <table class="not">
        <thead>
        @if (!empty($hutangHariIni))
                <tr>
                    <th>Hutang yang jatuh tempo</th>
                </tr>
            </thead>
        <tbody>
            
            @foreach($hutangHariIni as $hutang)
                <tr> 
                    <td>{{ $hutang['nama'] }} jumlah {{ $hutang['jumlah'] }}</td>
                   
                </tr>
            @endforeach
            @else
            
            @endif

            </tbody>
        </table>
        <table class="not">
        <thead>
        @if (!empty($hutangHariInI))
                <tr>
                    <th>Piutang yang jatuh tempo</th>
                </tr>
            </thead>
        <tbody>
            
            @foreach($hutangHariInI as $hutangX)
                <tr> 
                    <td>{{ $hutangX['nama'] }} jumlah {{ $hutangX['jumlah'] }}</td>
                </tr>
            @endforeach
            @else
            
            @endif

            </tbody>
        </table>
    </div>
</div>

<div id="myModul" class="modul">
    <div class="modul-content">
        <span class="close" onclick="closeModul()">&times;</span>
        <p>Nama : {{ Auth::user()->name }}</p>
        <p>{{ Auth::user()->email }}</p>
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link btn btn-warning">Logout</button>
        </form>
    </div>
</div>
<style>
        .not {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            background-color: #fff;
        }

        .not th, .not td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .not th {
            
            background-color: red;
            color: white;
        }

        .not tbody tr:nth-child(even) {
            background-color: #f2f2f2;
            
        }

        

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: fixed;
        height: 3rem;
        background-color: black;
        width: 100%;
    }
    img {
        height: 3rem;
    }
    .ic form{
        display: none;
    }
    .ic img {
        border-radius: 50%;
        height: 2rem;
        margin-right: 3rem ;
        cursor: pointer;
    }
    .ic img:hover {

    }
    .modal {
        margin-top: 3rem;
        display: none;
        position: fixed;
        height: auto;
        width: 13rem;
        left: 80%;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        border-radius: 10px;
        z-index:999999999 ;
    }
    .modul {
        display: none;
        position: fixed;
        height: auto;
        width: 12rem;
        top: 21%;
        left: 90%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        border-radius: 10px;
        z-index:999999999 ;
    }
    .modul p {
        font-weight: bold;
    }
    .nav-link.btn.btn-warning {
    color: #fff;
    background-color: #ffc107;
    border-color: #ffc107;
    padding: 8px 16px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

/* CSS untuk Hover Tombol Logout */
.nav-link.btn.btn-warning:hover {
    background-color: #e0a800;
}

@media only screen and (max-width: 600px) {
    .modal {
        left: 43%;
    }
    
    .modul {
        left: 75%;
        top: 23%;
    }
    .not {
        top: -12rem;
        margin-left: -0.1rem ;    
        }
    /* th, td {
        padding: 6px; 
        font-size: 14px; 
     } */


    
}
</style>
<script>
 // JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Get the modal element
    var modal = document.getElementById('myModal');
    var modul = document.getElementById('myModul');

    // Get the button that opens the modal
    var btn = document.getElementById('showModalButton');
    var btn1 = document.getElementById('showModulButton');

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName('close')[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = 'block';
    };

    btn1.onclick = function () {
        modul.style.display = 'block';
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = 'none';
        modul.style.display = 'none';
    };

    // When the user clicks anywhere outside of the modal or modul, close it
    window.onclick = function (event) {
        if (event.target == modal || event.target == modul) {
            modal.style.display = 'none';
            modul.style.display = 'none';
        }
    };

    // New function to close the modul when clicked anywhere on the page
    window.closeModul = function () {
        modul.style.display = 'none';
    };
});


</script>
