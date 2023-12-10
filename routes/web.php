<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookController;
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
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ExcelController;
// use Illuminate\Support\Facades\View;
use App\Http\Controllers\SearchController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

Route::resource('pemasukan', PemasukanController::class)->middleware('isLogin');
Route::resource('pengeluaran', PengeluaranController::class)->middleware('isLogin');
Route::resource('hutang', HutangController::class)->middleware('isLogin');
Route::resource('piutang', PiutangController::class)->middleware('isLogin');
Route::resource('rencana', RencanaBudgetController::class)->middleware('isLogin');
Route::resource('asset', AssetController::class)->middleware('isLogin');
// Route::post('pemasukan/{id}', 'PemasukanController@update')->name('pemasukan.update');

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('hari', function () {
//     return view('hari');
// });
Route::get('minggu', function () {
    return view('minggu');
})->middleware('isLogin');
Route::get('laporan', [LaporanController::class, 'lihat'])->middleware('isLogin');
Route::get('bulann', [BulanController::class, 'index'])->middleware('isLogin');
Route::get('tahun', [TahunController::class, 'tampilkanGrafikTahun'])->middleware('isLogin'); 
Route::get('hari', [HariController::class, 'tampilkanDataPerTanggal'])->middleware('isLogin');
Route::get('katagori', [KatagoriController::class, 'tampilkanDataPerKategori'])->middleware('isLogin'); 
// Route::get('asset', [AssetController::class, 'index']);
Route::get('cetak', [ExportController::class, 'index'])->middleware('isLogin');
// Route::get('/export-pemasukan-excel', [ExportController::class, 'exportPemasukanToExcel']);
// Route::get('/api/pemasukan', [ExportController::class, 'tespdf']);
Route::get('printPemasukan', [ExportController::class, 'printpemasukan']);
Route::get('printPengeluaran', [ExportController::class, 'printpengeluaran']);
Route::get('printHutang', [ExportController::class, 'printhutang']);
Route::get('printPiutang', [ExportController::class, 'printpiutang']);
Route::get('printRencana', [ExportController::class, 'printrencana']);
Route::get('printRencana', [ExportController::class, 'printrencana']);
Route::get('printLaporan', [ExportController::class, 'printlaporan']);
Route::get('printKatagori', [ExportController::class, 'printkatagori']);
Route::get('printAset', [ExportController::class, 'printaset']);
Route::get('printHari', [ExportController::class, 'printhari']);
Route::get('printMinggu', [ExportController::class, 'printminggu']);
Route::get('printBulan', [ExportController::class, 'printbulan']);
Route::get('printTahun', [ExportController::class, 'printtahun']);

Route::get('/', function () {
    return view('utama');
});

// Route::get('/halaman-error-404', function () {
//     return view('utama');
// });

Route::get('home', function () {
    return view('auth.dashboard');
})->middleware('isLogin');

Route::middleware('handle.attempt.to.read.property.error')->get('/', function () {
    return view('utama');
});
Route::get('/search-global', [SearchController::class, 'searchGlobal']);
// Route::get('/data-perbulan', [BulanController::class, 'getDataPerbulan']);

Route::controller(FacebookController::class)->group(function() {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});





Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

// Route::get('/auth/google/callback', function () {
//     $user = Socialite::driver('google')->user();

//     // Lakukan sesuatu dengan informasi pengguna seperti menyimpan ke basis data
//     // atau mengautentikasi pengguna ke dalam aplikasi
// });

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'google_token' => $googleUser->token,
        // tambahkan kolom lain sesuai kebutuhan
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

// Route::get('/auth/facebook/redirect', function () {
//     return Socialite::driver('facebook')->redirect();
// });

// // Route::get('/auth/facebook/callback', function () {
// //     $user = Socialite::driver('facebook')->user();

// //     // Lakukan sesuatu dengan informasi pengguna seperti menyimpan ke basis data
// //     // atau mengautentikasi pengguna ke dalam aplikasi
// // });

// Route::get('/auth/facebook/callback', function () {
//     $facebookUser = Socialite::driver('facebook')->user();

//     $user = User::updateOrCreate([
//         'facebook_id' => $facebookUser->id,
//     ], [
//         'name' => $facebookUser->name,
//         'email' => $facebookUser->email,
//         'facebook_token' => $facebookUser->token,
//         // tambahkan kolom lain sesuai kebutuhan
//     ]);

//     Auth::login($user);

//     return redirect('/dashboard');
// });
Route::get('/export', [ExcelController::class, 'export']);