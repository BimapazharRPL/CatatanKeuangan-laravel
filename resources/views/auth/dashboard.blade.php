<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/feather-icons"></script>
  <title>Dashboard</title>
  <link rel="icon" href="gambar/logoku.png">
</head>
<body>
@extends('layouts.master')
@section('content')
<div class="kuasa">
<div class="pencar">
<form id="searchForm">
            <input type="text" name="query" placeholder="Telusuri...">
            <button type="submit">Cari</button>
          </form>
          </div>
        <div id="searchResults"></div> 
          
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="aqua" fill-opacity="1" d="M0,32L40,48C80,64,160,96,240,112C320,128,400,128,480,112C560,96,640,64,720,74.7C800,85,880,139,960,170.7C1040,203,1120,213,1200,224C1280,235,1360,245,1400,250.7L1440,256L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
        </div>
        <script>
        document.getElementById('searchForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const query = document.querySelector('input[name="query"]').value;

    fetch(`/search-global?query=${query}`)
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data);
        });
      });

      function displaySearchResults(data) {
    searchResults.innerHTML = '';

    // Iterasi melalui hasil pencarian dan tambahkan ke elemen 'searchResults'
    for (const [model, results] of Object.entries(data)) {
        // Pengecekan apakah results memiliki elemen pertama
        if (results.length > 0) {
            // Membuat elemen tabel
            const table = document.createElement('table');
            table.border = '1'; // Menambah border untuk tabel (opsional)

            // Membuat elemen head tabel dengan nama model yang diformat
            const thead = table.createTHead();
            const headRow = thead.insertRow();
            const modelNameCell = headRow.insertCell();
            modelNameCell.colSpan = Object.keys(results[0]).length;
            modelNameCell.innerHTML = `<b>${formatModelName(model)}</b>`;

            // Iterasi melalui hasil pencarian dan tambahkan ke tabel
            results.forEach(result => {
                // Membuat elemen baris tabel
                const row = table.insertRow();

                // Menambahkan data ke dalam sel-sel tabel
                for (const key in result) {
                    // Memeriksa apakah key bukan created_at dan updated_at
                    if (key !== 'created_at' && key !== 'updated_at') {
                        const cell = row.insertCell();
                        cell.innerHTML = result[key];
                    }
                }

                // Tangani klik pada hasil pencarian
                row.addEventListener('click', function () {
                    // Logika untuk menanggapi hasil pencarian yang diklik
                });
            });

            // Menambahkan tabel ke dalam div dengan id 'searchResults'
            searchResults.appendChild(table);
        }
    }
}


    function formatModelName(model) {
    // Mengonversi nama model menjadi format yang diinginkan
    const modelNameMapping = {
        'pemasukans': 'Pemasukan',
        'pengeluarans': 'Pengeluaran',
        'hutangs': 'Hutang',
        'piutangs': 'Piutang',
        'rencanas': 'Rencana Budget',
        'assets': 'Asset'
        // Tambahkan model-model lain sesuai kebutuhan
    };

    return modelNameMapping[model.toLowerCase()] || model;
}
    </script>
          <style>
           
          /* CSS untuk container pencarian */
            .pencar {
                text-align: center;
                margin: 7rem 11rem;
            }

            /* CSS untuk form pencarian */
            #searchForm {
                display: inline-block;
            }

            /* CSS untuk input pencarian */
            #searchForm input[type="text"] {
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ddd;
                border-radius: 5px 0 0 5px;
            }

            /* CSS untuk tombol pencarian */
            #searchForm button {
                padding: 10px 15px;
                background-color: #f1f1f1;
                color: black;
                border: 1px solid #333;
                border-radius: 0 5px 5px 0;
                cursor: pointer;
                font-weight: bold;
            }

            /* Hover effect pada tombol pencarian */
            #searchForm button:hover {
                background-color: #2222;
            }
           .kuasa {
            align-items: center; 
            right: 0;
           }
           svg {
            width: 75rem;
           position: fixed;
           z-index: -9999;
           bottom: 0;
           right: 0;
           /* margin: 2rem -21rem; */
           }
           table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: left;
            }

            th {
                background-color: #3498db;
                color: #fff;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
                transition: background-color 0.3s ease;
            }

            /* Hover effect pada baris tabel */
            tr:hover {
                background-color: #2c3e50;;
                color: #fff;
                /* cursor: pointer; */
                transition: background-color 0.3s ease;
            }
            @media only screen and (max-width: 600px) {
                svg {
                    right: -19rem;
                }

                .pencar {
                    margin: 7rem -10rem;
                    right: 0;
                }
                .kuasa {
                    right: 0;
                    margin-left: -2rem;
                }
 
                #searchForm {
                    display: flex;
                    width: 100%;
                    text-align: center;
                    margin-bottom: 10px; /* Tambahkan margin bawah untuk estetika */
                }

                table {
                    width: 25rem;
                    margin-left: -13rem;
                    margin-right: -17rem;
                    right: 0;
                    
                }
                th, td {
                border: 1px solid #ddd;
                padding: 1px;
                text-align: center;
            }
            }
          </style>
           @endsection
      </body>
      <script>
    feather.replace();
</script>
</html>