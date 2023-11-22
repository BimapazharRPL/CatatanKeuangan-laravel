<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\BulanController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\KatagoriController;
use App\Http\Controllers\RencanaBudgetController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\TahunController;
// use Illuminate\Support\Facades\View;

// View::share('title', 'Nama Aplikasi');
// View::share('favicon', asset('gambar\logoku.png'));


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function() {
    //register form 
    Route::get('/register', 'register')->name('auth.register');
    //store register
    Route::post('/store', 'store')->name('auth.store');
    //login form
    Route::get('/login', 'login')->name('auth.login');
    //auth proses
    Route::post('/auth', 'auth')->name('auth.authentication');
    //logout
    Route::post('/logout', 'logout')->name('auth.logout');
    //dashboard page
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

Route::resource('pemasukan', PemasukanController::class)->middleware('auth');
Route::resource('pengeluaran', PengeluaranController::class)->middleware('auth');
Route::resource('hutang', HutangController::class);
Route::resource('piutang', PiutangController::class);
Route::resource('rencana', RencanaBudgetController::class);
// Route::post('pemasukan/{id}', 'PemasukanController@update')->name('pemasukan.update');

Route::get('/', function () {
    return view('welcome');
});
// Route::get('hari', function () {
//     return view('hari');
// });
Route::get('minggu', function () {
    return view('minggu');
});
Route::get('laporan', [LaporanController::class, 'lihat'])->middleware('auth');
Route::get('/bulan', [BulanController::class, 'index']);
Route::get('tahun', [TahunController::class, 'tampilkanGrafikTahun']); 
Route::get('hari', [HariController::class, 'tampilkanDataPerTanggal']);
Route::get('katagori', [KatagoriController::class, 'tampilkanDataPerKategori']); 
Route::get('asset', [AssetController::class, 'index']);

Route::get('utama', function () {
    return view('utama');
});