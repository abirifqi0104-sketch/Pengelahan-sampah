<?php

use Illuminate\Support\Facades\Route;

// user notification routes
require __DIR__ . '/user_notifications.php';

// (legacy) jika masih ada, biarkan tapi bisa dihapus nanti
require __DIR__ . '/notifications_user.php';



use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\MaggotController;
use App\Http\Controllers\MaggotCultivationController;
use App\Http\Controllers\PanenMaggotController;
use App\Http\Controllers\ProdukOlahanController; // Pastikan ini terpanggil
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\VerifikasiController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::get('/register', function () { return view('auth.register'); })->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (ADMIN, USER, PROFILE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

        // DASHBOARD & CHART
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/chart-data', [AdminController::class, 'getChartData'])->name('chart-data');

        // NASABAH & SALDO
        Route::get('/nasabah', [AdminController::class, 'nasabah'])->name('nasabah');
        Route::get('/saldo', [AdminController::class, 'saldo'])->name('saldo');

        // TRANSACTIONS / SETORAN
        Route::prefix('transactions')->name('transactions.')->group(function () {
            Route::get('/', [TransactionController::class, 'index'])->name('index');
            Route::get('/create', [TransactionController::class, 'create'])->name('create');
            Route::post('/store', [TransactionController::class, 'store'])->name('store');
            Route::get('/riwayat', [AdminController::class, 'riwayat'])->name('riwayat');
            Route::get('/archive', [AdminController::class, 'archive'])->name('archive');
            
            // Parameter {id} ditaruh di bawah agar aman
            Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/restore', [AdminController::class, 'restore'])->name('restore');
            Route::delete('/{id}/force-delete', [AdminController::class, 'forceDelete'])->name('forceDelete');
        });

        // VERIFIKASI
        Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
            Route::get('/', [VerifikasiController::class, 'index'])->name('index');
            Route::put('/{id}/approve', [VerifikasiController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [AdminController::class, 'reject'])->name('reject');
        });
        Route::get('/verifikasi-list', [VerifikasiController::class, 'index'])->name('verifikasi'); 

        // GUDANG SAMPAH
        Route::prefix('gudang')->name('gudang.')->group(function () {
            Route::get('/', [GudangController::class, 'index'])->name('index');
            Route::get('/create', [GudangController::class, 'create'])->name('create');
            Route::post('/store', [GudangController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [GudangController::class, 'edit'])->name('edit');
            Route::put('/{id}', [GudangController::class, 'update'])->name('update');
            Route::delete('/{id}', [GudangController::class, 'destroy'])->name('destroy');
        });

        // MANAJEMEN MAGGOT BSF (Siklus, Panen, dan Penjualan)
        Route::prefix('maggot')->name('maggot.')->group(function () {
            
            // 1. DATA BUDIDAYA (Utama)
            Route::get('/', [MaggotCultivationController::class, 'index'])->name('index');
            Route::get('/create', [MaggotController::class, 'create'])->name('create');
            Route::post('/store', [MaggotCultivationController::class, 'store'])->name('store');
            Route::post('/store-form', [MaggotController::class, 'store'])->name('store-form');
            
            // 2. PANEN MAGGOT
            Route::get('/panen', [PanenMaggotController::class, 'index'])->name('panen');
            Route::get('/panen/create', [PanenMaggotController::class, 'create'])->name('panen.create');
            Route::post('/panen/store', [PanenMaggotController::class, 'store'])->name('panen.store');
            Route::post('/maggot-cultivation/{id}/panen', [MaggotCultivationController::class, 'prosesPanen'])->name('proses-panen');

            // 3. PENJUALAN PRODUK OLAHAN
            Route::prefix('penjualan')->name('penjualan.')->group(function () {
                Route::get('/', [MaggotController::class, 'penjualan'])->name('index');
                Route::post('/tambah', [MaggotController::class, 'tambahProduk'])->name('tambah');
                Route::get('/{id}/edit', [MaggotController::class, 'editProduk'])->name('edit');
                Route::put('/{id}', [MaggotController::class, 'updateProduk'])->name('update');
                Route::delete('/{id}', [MaggotController::class, 'hapusProduk'])->name('hapus');
                Route::post('/konversi', [ProdukOlahanController::class, 'konversiPanen'])->name('konversi');
            });

            // 4. RUTE UPDATE FASE & HAPUS SIKLUS (Tepat berada di paling bawah grup Maggot agar aman)
            Route::post('/update-fase/{id}', [MaggotCultivationController::class, 'updateFase'])->name('updateFase');
            Route::delete('/{id}', [MaggotCultivationController::class, 'destroy'])->name('destroy');
        });

        // FITUR LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

        // WITHDRAWAL (PENARIKAN)
        Route::prefix('withdraw')->name('withdraw.')->group(function () {
            Route::get('/', [WithdrawalController::class, 'adminIndex'])->name('index');
            Route::post('/{id}/approve', [WithdrawalController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [WithdrawalController::class, 'reject'])->name('reject');
            Route::post('/{id}/process', [WithdrawalController::class, 'process'])->name('process');
        });

        // INFORMATION MANAGEMENT (Mendukung alias 'informasi' & 'information')
        Route::prefix('informasi')->name('informasi.')->group(function () {
            Route::get('/', [InformationController::class, 'adminIndex'])->name('index');
            Route::get('/create', [InformationController::class, 'create'])->name('create');
            Route::post('/store', [InformationController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [InformationController::class, 'edit'])->name('edit');
            Route::put('/{id}', [InformationController::class, 'update'])->name('update');
            Route::delete('/{id}', [InformationController::class, 'destroy'])->name('destroy');
        });
        
        // Alias rute informasi (Untuk kebebasan Blade)
        Route::get('/informasi/list-en', [InformationController::class, 'adminIndex'])->name('information.index'); 
        Route::get('/informasi/list-all', [InformationController::class, 'adminIndex'])->name('transactions.informasi.index'); 
        Route::get('/informasi/create-en', [InformationController::class, 'create'])->name('information.create'); 
        Route::post('/informasi/store-en', [InformationController::class, 'store'])->name('information.store');
        Route::get('/informasi/{id}/edit-en', [InformationController::class, 'edit'])->name('information.edit');
        Route::put('/informasi/{id}/update-en', [InformationController::class, 'update'])->name('information.update');
        Route::delete('/informasi/{id}/delete-en', [InformationController::class, 'destroy'])->name('information.destroy');

    });

    /*
    |--------------------------------------------------------------------------
    | USER AREA
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')->name('user.')->middleware('user')->group(function () {
        
        // DASHBOARD & TENTANG
        Route::get('/dashboard', [TransactionController::class, 'userDashboard'])->name('dashboard');
        Route::get('/tentang', function () { return view('user.tentang'); })->name('tentang');
        
        // SETORAN SAMPAH & TRANSAKSI
        Route::get('/submit-waste', [TransactionController::class, 'create'])->name('submit-waste');
        Route::post('/setoran-sampah', [TransactionController::class, 'storeSetoran'])->name('setoran.store');
        Route::post('/submit-waste', [TransactionController::class, 'storeSetoran'])->name('submit-waste.store'); // Alias
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
        Route::get('/history', [TransactionController::class, 'userHistory'])->name('history');
        
        // WITHDRAWAL (PENARIKAN)
        Route::prefix('withdraw')->name('withdraw.')->group(function () {
            Route::get('/', [WithdrawalController::class, 'index'])->name('index');
            Route::get('/create', [WithdrawalController::class, 'create'])->name('create');
            Route::post('/store', [WithdrawalController::class, 'store'])->name('store');
        });

        // INFORMATION
        Route::prefix('informasi')->name('informasi.')->group(function () {
            Route::get('/', [InformationController::class, 'userIndex'])->name('index');
            Route::get('/{id}', [InformationController::class, 'userShow'])->name('show');
        });
        // Alias
        Route::get('/information', [InformationController::class, 'userIndex'])->name('information.index');
        Route::get('/information/{id}', [InformationController::class, 'userShow'])->name('information.show');
        
        // NOTIFICATIONS
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('markAllRead');
            Route::post('/{id}/read', [NotificationController::class, 'mark'])->name('read');
            Route::delete('/{id}', [NotificationController::class, 'delete'])->name('delete');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | PROFILE GLOBAL (Bisa diakses Admin maupun User)
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

});