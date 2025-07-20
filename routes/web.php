<?php

use Livewire\Livewire;
use App\Livewire\Home;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Main;
use App\Livewire\Tps\DataTps;
use App\Livewire\Tpa\DataTpa;
use App\Livewire\Uptd\DataUptd;
use App\Livewire\Sampah\DataSampah;
use App\Livewire\Iot\DataIot;
use App\Livewire\Jadwal\Pengangkutan;
use App\Livewire\Report\Pelaporan;
use App\Http\Middleware\CheckRole;
use App\Livewire\Auth\ChangePassword;
use App\Livewire\Auth\ChangePasswordEmail;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Driver\DataDriver;
use App\Livewire\Profile\ViewProfile;
use App\Livewire\Report\LaporanBulanan;
use App\Livewire\Report\LaporanMingguan;
use App\Livewire\Report\LaporanTahunan;
use App\Livewire\Setting\ManageRole;
use App\Livewire\Setting\Role\SettingRole;
use App\Livewire\Setting\Roles;
use App\Livewire\Tpa\InputRitasi;
use App\Livewire\Uptd\AddDriver;

// Route::get('/', function () {
    //     return view('welcome');
    // });
    // Route::get('/register', Register::class)->name('register');
    
    // Route::get('/' , Home::class)->name('home');
    // Route::get('/login', \App\Livewire\Auth\Login::class)
    //             ->middleware('auth')
    //             ->name('login');
    Route::get('/', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

    // Route::get('/change-password', ChangePassword::class)->name('change-password');
    Route::get('/change-password-email', ChangePasswordEmail::class)->name('change-password-email');

    
    Route::get('/view-profile', ViewProfile::class)->name('view-profile');

    Route::middleware(['auth', CheckRole::class . ':admin,dlh,uptd,operator tpa'])->group(function () {
        Route::get('/dashboard', Main::class)->name('dashboard');
    });

    // Data TPS dan TPA (admin, dlh, operator_tpa)
    Route::middleware(['auth', CheckRole::class . ':admin,dlh,operator tpa'])->group(function () {
        Route::get('/data-tps', DataTPS::class)->name('data-tps');
        Route::get('/data-tpa', DataTpa::class)->name('data-tpa');

        Route::get('/input-ritasi/{tpa}', InputRitasi::class)->name('input-ritasi');
    });

    // Data UPTD (Super Admin, dlh, uptd)
    Route::middleware(['auth', CheckRole::class . ':admin,dlh,uptd'])->group(function () {
        Route::get('/data-uptd', DataUptd::class)->name('data-uptd');

        Route::get('/add-driver/{driver}', AddDriver::class)->name('add-driver');
    });

    // Pendataan Sampah, Driver, IoT (Super Admin, operator_tpa)
    Route::middleware(['auth', CheckRole::class . ':admin,operator tpa'])->group(function () {
        Route::get('/data-sampah', DataSampah::class)->name('data-sampah');
        Route::get('/data-driver', DataDriver::class)->name('data-driver');
        Route::get('/data-iot', DataIot::class)->name('data-iot');
    });

    // Pengangkutan (Super Admin, dlh, uptd, operator_tpa)
    Route::middleware(['auth', CheckRole::class . ':Super Admin,dlh,uptd,operator_tpa'])->group(function () {
        Route::get('/pengangkutan', Pengangkutan::class)->name('pengangkutan');
    });

    // Pelaporan (Super Admin, dlh, uptd, operator_tpa)
    Route::middleware(['auth', CheckRole::class . ':admin,dlh,uptd,operator tpa'])->group(function () {
        Route::get('/pelaporan', Pelaporan::class)->name('pelaporan');
        Route::get('/laporan-mingguan', LaporanMingguan::class)->name('laporan-mingguan');
        Route::get('/laporan-bulanan', LaporanBulanan::class)->name('laporan-bulanan');
        Route::get('/laporan-tahunan', LaporanTahunan::class)->name('laporan-tahunan');
    });

    // Manage Role (hanya Super Admin)
    Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
        Route::get('/manage-role', ManageRole::class)->name('manage-role');
    });

     // Manage Role (hanya Super Admin)
     Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
        Route::get('/roles', Roles::class)->name('roles');
    });

    // ===================== ADMIN =====================
// Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
//     // Route::get('/dashboard', Main::class)->name('dashboard');
//     Route::get('/data-tps', DataTPS::class)->name('data-tps');
//     Route::get('/data-tpa', DataTpa::class)->name('data-tpa');
//     Route::get('/data-uptd', DataUptd::class)->name('data-uptd');
//     Route::get('/pengangkutan', Pengangkutan::class)->name('pengangkutan');
//     Route::get('/data-sampah', DataSampah::class)->name('data-sampah');
//     Route::get('/data-driver', DataDriver::class)->name('data-driver');
//     Route::get('/data-iot', DataIot::class)->name('data-iot');
//     Route::get('/pelaporan', Pelaporan::class)->name('pelaporan');
//     Route::get('/laporan-mingguan', LaporanMingguan::class)->name('laporan-mingguan');
//     Route::get('/laporan-bulanan', LaporanBulanan::class)->name('laporan-bulanan');
//     Route::get('/laporan-tahunan', LaporanTahunan::class)->name('laporan-tahunan');
//     // tambah route untuk setting user di sini jika kamu punya:
//     Route::get('/manage-role', ManageRole::class)->name('manage-role');
// });

// // ===================== DLH =====================
// Route::middleware(['auth', CheckRole::class . ':dlh'])->group(function () {
//     // Route::get('/dashboard', Main::class)->name('dashboard');
//     Route::get('/data-tps', DataTPS::class)->name('data-tps');
//     Route::get('/data-tpa', DataTpa::class)->name('data-tpa');
//     Route::get('/data-uptd', DataUptd::class)->name('data-uptd');
//     Route::get('/pengangkutan', Pengangkutan::class)->name('pengangkutan');
//     Route::get('/pelaporan', Pelaporan::class)->name('pelaporan');
// });

// // ===================== UPTD =====================
// Route::middleware(['auth', CheckRole::class . ':uptd'])->group(function () {
//     // Route::get('/dashboard', Main::class)->name('dashboard');
//     Route::get('/data-uptd', DataUptd::class)->name('data-uptd');
//     Route::get('/pengangkutan', Pengangkutan::class)->name('pengangkutan');
//     Route::get('/pelaporan', Pelaporan::class)->name('pelaporan');
// });

// // ===================== OPERATOR TPA =====================
// Route::middleware(['auth', CheckRole::class . ':operator_tpa'])->group(function () {
//     // Route::get('/dashboard', Main::class)->name('dashboard');
//     Route::get('/data-tpa', DataTpa::class)->name('data-tpa');
//     Route::get('/data-tps', DataTPS::class)->name('data-tps');
//     Route::get('/data-sampah', DataSampah::class)->name('data-sampah');
//     Route::get('/data-driver', DataDriver::class)->name('data-driver');
//     Route::get('/data-iot', DataIot::class)->name('data-iot');
//     Route::get('/pengangkutan', Pengangkutan::class)->name('pengangkutan');
//     Route::get('/pelaporan', Pelaporan::class)->name('pelaporan');
// });




    // Route::get('/data-tps', function () {
    //     return view('pages.data-tps');
    // });
    
