<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ExportController extends Controller
{
    public function exportToExcel()
    {
        $data = YourModel::all(); // Ganti dengan model dan data Anda

        return Excel::download(new YourExportClass($data), 'nama_file.xlsx');
    }
}


